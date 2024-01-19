@extends('emails.template')

@section('title', "Olá, {$usuario['nome']}!")

@section('content')
    <pre style="width:100%;">
        <span style="text-align:center">
          Você está recebendo esta mensagem pois houve um cadastro de despesa a partir de um usuário com o seu endereço de e-mail.
        </span>
    </pre>
@endsection