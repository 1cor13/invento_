<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function index() {
        $myVars = [
            ['Order1', 'Customer11'],
            ['Order2', 'Customer2'],
            ['Order3', 'Customer3'],
            ['Order4', 'Customer4']
        ];
        $myName = 'Blaaah';
    
        return view('sample', compact('myVars','myName'));
    }

    public function create() {

    }

    public function store() {

    }

    public function show() {
        
    }

    public function edit() {
        
    }

    public function update() {
        
    }

    public function destroy() {
        
    }
}
