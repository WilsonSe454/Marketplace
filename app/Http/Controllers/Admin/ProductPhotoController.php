<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductPhoto;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function removerPhoto(Request $request)// Como a foto tem um nome único vc pode passar o nome dela no lugar do id
    {
        //lembre te ter criado o link simbólico da pasta public/storege para a pasta storege/app/public

        //Busco a foto no banco pelo ID dela ou pelo nome
        $photoName = $request->get('photoName'); //Buscando o nome da foto no request
        //Removo do arquivos
        if(Storage::disk('public')->exists($photoName)){
            Storage::disk('public')->delete($photoName);
        }

        //Removo a imagem do banco
        $removoPhoto = ProductPhoto::where('image', $photoName);

        $productId = $removoPhoto->first()->product_id;//Pegando o id do produto para passar no redirect

        $removoPhoto->delete();

        flash('Imagem removida com sucesso!')->success();
        return redirect()->route('admin.products.edit', ['product' => $productId]);

    }
}
