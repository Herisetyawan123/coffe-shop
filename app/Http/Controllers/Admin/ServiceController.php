<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::paginate(10);
        return view('admin.pages.service.index', compact('services'));
    }

    public function add(){
        return view('admin.pages.service.add');
    }

    public function edit($id){
        $service = Service::findOrFail($id);
        return view('admin.pages.service.edit', compact('service'));
    }

    public function store(Request $request){
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);

            Service::create($request->all());
            return redirect()->route('service.index')->with('success', 'Berhasil menambah data service');
        } catch (\Throwable $th) {
            return redirect()->route('service.index')->with('error', 'Gagal menambah data service');
        }
    }
    
    public function update(Request $request){
        try {
            $request->validate([
                'id' => 'required',
                'title' => 'required',
                'description' => 'required',
            ]);

            $service = Service::find($request->id);
            $service->title = $request->title;
            $service->description = $request->description;
            $service->save();
            return redirect()->route('service.index')->with('success', 'Berhasil mengedit data service');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal mengedit data service');
        }
    }

    public function delete($id){
        try {
            $service = Service::findOrFail($id);
            $service->delete();
            return redirect()->route('service.index')->with('success', 'Berhasil menghapus service');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menghapus data service');
        }
    }
}
