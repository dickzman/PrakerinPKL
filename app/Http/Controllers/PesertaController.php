<?php

namespace App\Http\Controllers;

use DataTables;
use App\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{

    public function data_json()
    {
        return DataTables::of(Peserta::all())
        ->addColumn('action', function ($row) {

                  $action = '
                            <div class="text-center">
                            <a href="'.route('peserta.edit', $row->kode_pst).'" class="btn btn-md bg-olive bg-flat" id="edit_klik"
                            name="button"> <i class="fa fa-edit"></i></a> || ';

                  $action .= \Form::open(['url' => 'peserta/'.$row->kode_pst,'method' => 'delete',
                            'style' => 'display:inline',
                            'onsubmit' => 'return confirm("Hapus Data ?")']);

                  $action .= '
                              <button type="submit" class="btn btn-md bg-maroon bg-flat" name="button"><i class="fa fa-trash"></i></button>';

                  $action .= \Form::close().'</div>';

                  return $action;
             })
        ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('peserta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peserta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request, [
            'kode_pst' => 'required|unique:peserta,kode_pst',
            'nama_pst' => 'required',
            'instansi' => 'required|',
            'jenis_kelamin' => 'required',
            'masuk' => 'required',
            'keluar' => 'required',
            'status' => 'required',
        ]);


        $save = new Peserta;
        $save->kode_pst = $request->input('kode_pst');
        $save->nama_pst = $request->input('nama_pst');
        $save->instansi = $request->input('instansi');
        $save->jenis_kelamin  = $request->input('jenis_kelamin');
        $save->masuk = $request->input('masuk');
        $save->keluar = $request->input('keluar');
        $save->status = $request->input('status');
        $save->save();

        return redirect()->route('peserta.index')->with('pesertaCreate', 'Berhasil menambahkan peserta');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Peserta::FindorFail($id);
        return view('peserta.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $except = Peserta::FindOrFail($request->kode_pst);

        if ($except->kode_pst != $request->kode_pst) {
            abort(404);
            die;
        }

      $validator = $this->validate($request, [
          'kode_pst' => 'required|unique:peserta,kode_pst,'.$except->kode_pst.',kode_pst',
          'nama_pst' => 'required',
          'instansi' => 'required|',
          'jenis_kelamin' => 'required',
          'masuk' => 'required',
          'keluar' => 'required',
          'status' => 'required',
      ]);

        $update = Peserta::FindOrFail($request->kode_pst);
        $update->nama_pst = $request->input('nama_pst');
        $update->instansi = $request->input('instansi');
        $update->jenis_kelamin  = $request->input('jenis_kelamin');
        $update->masuk = $request->input('masuk');
        $update->keluar = $request->input('keluar');
        $update->status = $request->input('status');
        $update->save();

        return redirect()->route('peserta.index')->with('pesertaUpdate', 'Update data peserta berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = Peserta::FindorFail($id);
        $hapus->delete();
        return redirect()->route('peserta.index')->with('pesertaDelete', 'Hapus data peserta berhasil');
    }

    public function trash()
    {
      return view('peserta.trash');
    }

    public function trash_json()
    {
      return DataTables::of(Peserta::onlyTrashed()->get())
                            ->addColumn('action', function ($row) {
                                      $url_restore = route('peserta_trash.restore', $row->kode_pst);
                                      $action = '
                                          <div class="text-center">
                                          <a href="'.$url_restore.'"class="btn btn-md bg-olive bg-flat"> <i class="fa fa-window-restore"></i> </a> || ';

                                      $url_trash_permanent = "/peserta/'.$row->kode_pst.'/delete";
                                      $action .= \Form::open(['route' => ['peserta.delete', $row->kode_pst],
                                          'method' => 'delete',
                                          'style' => 'display:inline',
                                          'onsubmit' => 'return confirm("Hapus Data permanen ?")']);
                                      $action .= '<button type="submit" class="btn btn-md bg-maroon bg-flat" name="button"><i class="fa fa-trash"></i></button>';
                                      $action .= \Form::close().'</div>';

                                      return $action;
                                 })
                            ->make(true);
    }

    public function restore($id)
    {
        $data = Peserta::withTrashed()->FindOrFail($id);
          if ($data) {
              $data->restore();
          }

          return redirect()->route('peserta.index')->with('pesertaRestore', 'Restore data peserta berhasil');


    }

    public function delete_permanent($id)
    {
        $data = peserta::withTrashed()->FindOrFail($id);
          if ($data->trashed()) {
                $data->forceDelete();
          }

          return redirect()->route('peserta.trash')->with('pesertaPermanent', 'Hapus permanen peserta berhasil');
    }
}
