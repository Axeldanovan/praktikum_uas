<?php
namespace App\Controllers;

use App\Models\WargaModels;

class Warga extends BaseController
{
    public function index()
    {
        $title = 'Daftar Warga';
        $model = new WargaModels();
        $warga = $model->findAll();
        return view('warga/index', compact('warga', 'title'));
    }

    public function admin_index()
    {
        $title = 'Daftar Warga';
        $model = new WargaModels();
        $warga = $model->findAll();
        return view('warga/admin_index', compact('warga', 'title'));
    }

    public function add()
    {
        // validasi data.
        $validation = \Config\Services::validation();
        $validation->setRules(['nik' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
    
        if ($isDataValid)
        {
            $warga = new WargaModels();
            $warga->insert([
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'kelamin' => $this->request->getPost('kelamin'),
                'alamat' => $this->request->getPost('alamat'),
                'no_rumah' => $this->request->getPost('no_rumah')
            ]);
            return redirect('admin/warga');
        }
        $title = "Tambah Warga";
        return view('warga/form_add', compact('title'));
    }

    public function edit($warga_id)
    {
        $warga = new WargaModels();
        // validasi data.
        $validation = \Config\Services::validation();
        $validation->setRules(['nik' => 'required']);
        $isDataValid = $validation->withRequest($this->request)->run();
        
        if ($isDataValid)
        {
            $warga->update($warga_id, [
                'nik' => $this->request->getPost('nik'),
                'nama' => $this->request->getPost('nama'),
                'kelamin' => $this->request->getPost('kelamin'),
                'alamat' => $this->request->getPost('alamat'),
                'no_rumah' => $this->request->getPost('no_rumah'),
            ]);
            return redirect('admin/warga');
        }
        
        // ambil data lama
        $data = $warga->where('warga_id', $warga_id)->first();
        $title = "Edit Data Warga";
        return view('warga/form_edit', compact('title', 'data'));
    }

    public function delete($warga_id)
    {
        $warga = new WargaModels();
        $warga->delete($warga_id);
        return redirect('admin/warga');
    }
}