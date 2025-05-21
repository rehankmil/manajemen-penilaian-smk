<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; 

class MuridRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'password' => 'required|string|min:8|confirmed',
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|string|in:L,P',
            'tgl_lahir' => 'required|date',
            'avatar' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
        ];

        // NIP rule berbeda untuk create dan update
        if ($this->isMethod('post')) {
            $rules['nis'] = 'required|string|max:20|unique:murid,nis';
        } else {
            $rules['nis'] = [
                'required',
                'string',
                'max:20',
                Rule::unique('murid')->ignore($this->murid)
            ];
        }

        return $rules;
    }

        /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nis.required' => 'NIS wajib diisi',
            'nis.unique' => 'NIS sudah digunakan',
            'password.required' => 'Kata sandi wajib diisi',
            'password.min' => 'Kata sandi minimal berjumlah 8 karakter',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai',
            'nama.required' => 'Nama wajib diisi',
            'no_telp.required' => 'Nomor telepon wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi',
            'tgl_lahir.date' => 'Format tanggal lahir tidak valid',
            'avatar.required' => 'Avatar wajib dipilih',
            'kelas_id.required' => 'Kelas wajib dipilih',
            'kelas_id.exists' => 'Kelas tidak valid',
        ];
    }
}
