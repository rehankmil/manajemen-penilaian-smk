<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuruRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                Rule::unique('gurus')->ignore($this->guru)
            ],
            'no_telp' => 'required|string|max:15',
            'jenis_kelamin' => 'required|string',
            'tgl_lahir' => 'required|date',
            'avatar' => 'required|string',
            'mapel_id' => 'required|exists:mapels,id',
        ];

        // NIP rule berbeda untuk create dan update
        if ($this->isMethod('post')) {
            $rules['nip'] = 'required|string|max:20|unique:gurus,nip';
        } else {
            $rules['nip'] = [
                'required',
                'string',
                'max:20',
                Rule::unique('gurus')->ignore($this->guru)
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
            'nip.required' => 'NIP wajib diisi',
            'nip.unique' => 'NIP sudah digunakan',
            'password.required' => 'Kata Sandi wajib diisi',
            'password.min' => 'Kata Sandi minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai',
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'no_telp.required' => 'Nomor telepon wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi',
            'tgl_lahir.date' => 'Format tanggal lahir tidak valid',
            'avatar.required' => 'Avatar wajib dipilih',
            'mapel_id.required' => 'Mata pelajaran wajib dipilih',
            'mapel_id.exists' => 'Mata pelajaran tidak valid',
        ];
    }
}