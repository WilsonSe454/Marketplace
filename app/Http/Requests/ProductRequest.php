<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required|min:30',
            'body' => 'required',
            'price' => 'required',
            'photos.*' => 'image'/* Quando tem que validar um array usa-se o .* quando o endice é numerado */
        ];
    }
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'min' => 'A :attribute deve ter pelo menos :min caracteres.',
            'image' => 'Arquivo não é uma imagem válida!'
        ];
    }

    /* 
    Exeplos:
    
    <input type="text" name="profile[name]">
    <input type="text" name="profile[email]">

    como ele vai chegar
    [profile] => [name => '', email => '']

    no Request
    'profile.name' => 'required',
    'profile.email' => 'required|email',

    @error('profile.name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>       
    @enderror

    */
    
}
