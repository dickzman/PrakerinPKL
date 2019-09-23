<?php

namespace App\Http\Controllers;

use DataTables;
use App\Pembimbing;
use Illuminate\Http\Request;

class PembimbingController extends Controller
{

    public function data_json()
    {
      return DataTables::of(pembimbing::all())
                        ->addColumn('foto', function ($row) {
                            $url = asset('storage/'.$row->foto);
                            $img = '<img src="'.$url.'" alr="" width="70px">';
                            return $img;
                        })
                        ->addColumn('action', function ($row) {
                                  $urlEdit = route('pembimbing.edit', $row->nik_nip);
                                  $action = '
                                      <div class="text-center">
                                      <a href="'.$urlEdit.'" class="btn btn-md bg-olive bg-flat"> <i class="fa fa-edit"></i> </a> || ';

                                  $action .= \Form::open(['url' => 'pembimbing/'.$row->nik_nip,'method' => 'delete',
                                      'style' => 'display:inline',
                                      'onsubmit' => 'return confirm("Hapus Data ?")']);
                                  $action .= '<button type="submit" class="btn btn-md bg-maroon bg-flat" name="button"><i class="fa fa-trash"></i></button>';
                                  $action .= \Form::close().'</div>';

                                  return $action;
                             })
                        ->rawColumns(['foto', 'action'])
                        ->make(true);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pembimbing.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pembimbing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nik_nip' => 'required|unique:pembimbing,nik_nip',
            'nama'    => 'required',
            'email'   => 'required|unique:pembimbing,email',
            'no_hp'   => 'required',
            'foto'    => 'required'
        ]);

        $pembimbing = new Pembimbing;
        $pembimbing->nik_nip = $request->input('nik_nip');
        $pembimbing->nama    = $request->input('nama');
        $pembimbing->email   = $request->input('email');
        $pembimbing->no_hp   = $request->input('no_hp');

        $file = $request->file('foto')->store('foto_pembimbing', 'public');
        $pembimbing->foto = $file;
        $pembimbing->save();

        return redirect()->route('pembimbing.index')->with('pembimbingCreate', 'Berhasil menambahkan data Pembimbing');
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
        $data = Pembimbing::FindOrFail($id);
        return view('pembimbing.edit', compact('data'));
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
          $except = Pembimbing::FindOrFail($id);

          $this->validate($request, [
              'nik_nip' => 'required|unique:pembimbing,nik_nip,'.$id.',nik_nip',
              'nama'    => 'required',
              'email'   => 'required|unique:pembimbing,email,'.$except->email.',email',
              'no_hp'   => 'required',
              'foto'    => 'sometimes'
          ]);

          $pembimbing = Pembimbing::FindOrFail($id);

          if ($pembimbing->nik_nip != $request->nik_nip) {
              abort(404);
              die;
          }

          if ($request->foto) {
              if (file_exists(storage_path('app/public/'.$pembimbing->foto))) {
                  \Storage::delete('public/'.$pembimbing->foto);
                  $file = $request->file('foto')->store('foto_pembimbing', 'public');
                  $pembimbing->foto = $file;
              }else {
                $file = $request->file('foto')->store('foto_pembimbing', 'public');
                $pembimbing->foto = $file;
              }
          }

          $pembimbing->nik_nip = $request->input('nik_nip');
          $pembimbing->nama    = $request->input('nama');
          $pembimbing->email   = $request->input('email');
          $pembimbing->no_hp   = $request->input('no_hp');
          $pembimbing->save();

          return redirect()->route('pembimbing.index')->with('pembimbingUpdate', 'Berhasil update data Pembimbing');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembimbing = Pembimbing::FindOrFail($id);
        $pembimbing->delete();
        return redirect()->route('pembimbing.index')->with('pembimbingDelete', 'Hapus data pembimbing berhasil');
    }

    public function trash()
    {
        return view('pembimbing.trash');
    }

    public function trash_json()
    {
      return DataTables::of(Pembimbing::onlyTrashed()->get())
                        ->addColumn('foto', function ($row) {
                            $url = asset('storage/'.$row->foto);
                            $img = '<img src="'.$url.'" alr="" width="70px">';
                            return $img;
                        })
                        ->addColumn('action', function ($row) {
                                  $url_restore = route('pembimbing_trash.restore', $row->nik_nip);
                                  $action = '
                                      <div class="text-center">
                                      <a href="'.$url_restore.'" class="btn btn-md bg-olive bg-flat"> <i class="fa fa-window-restore"></i> </a> || ';

                                  $action .= \Form::open(['route' => ['pembimbing.delete', $row->nik_nip],
                                      'method' => 'delete',
                                      'style' => 'display:inline',
                                      'onsubmit' => 'return confirm("Hapus Data permanen ?")']);
                                  $action .= '<button type="submit" class="btn btn-md bg-maroon bg-flat" name="button"><i class="fa fa-trash"></i></button>';
                                  $action .= \Form::close().'</div>';

                                  return $action;
                             })
                        ->rawColumns(['foto', 'action'])
                        ->make(true);
    }

    public function restore($id)
    {
        $data = Pembimbing::withTrashed()->FindorFail($id);
          if ($data) {
              $data->restore();
          }

          return redirect()->route('pembimbing.index')->with('pembimbingRestore', 'Restore data pembimbing berhasil');
    }

    public function delete_permanent($id)
    {
        $data = Pembimbing::withTrashed()->FindOrFail($id);
          if ($data) {
              $data->forceDelete();
              \Storage::delete('public/'.$data->foto);
          }

          return redirect()->route('pembimbing.trash')->with('pembimbingPermanent', 'Hapus permanen data Pembimbing berhasil');
    }
}
