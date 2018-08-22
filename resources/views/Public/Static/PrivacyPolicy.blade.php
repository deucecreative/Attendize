@extends('Shared.Layouts.MasterWithoutMenus')

@section('title')
    Privacy Policy
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-body">
                    <h3>Privacy Policy</h3>

                    <p>Please click the following link to view/download our privacy policy:</p>

                    <p><a href="{{ asset('assets/pdf/GDPR Data Privacy Notice for housenights.com.pdf') }}" style="text-decoration: underline;">GDPR Data Privacy Notice for housenights.com</a></p>
                </div>
            </div>
        </div>
    </div>
@stop
