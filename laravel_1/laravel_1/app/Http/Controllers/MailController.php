<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\CloudHostingProduct;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller{

    public function mail(){      
        $name = 'Missatge';    
        Mail::to('jorgegzgc@gmail.com')->send(new CloudHostingProduct($name));
        return view('enviarMail',compact('name'));
    }

}

?>
