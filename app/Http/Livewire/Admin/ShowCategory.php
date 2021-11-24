<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;

class ShowCategory extends Component
{
    public $category, $subcategories, $subcategory;
    protected $listeners = ['delete'];

    protected $rules =[
        'createForm.name' => 'required',
        'createForm.slug' => 'required|unique:subcategories,slug',

    ];

    protected $validationAttributes =[
        'createForm.name' => 'nombre',
        'createForm.slug' => 'slug',
        'editForm.name' => 'nombre',
        'editForm.slug' => 'slug',

    ];

    public $createForm =[
        'name' => null,
        'slug' => null,
    ];

    public $editForm =[
        'open' => false,
        'name' => null,
        'slug' => null,

    ];

    public function updatedCreateFormName($value){
        $this->createForm['slug'] = Str::slug($value);
    }

    public function updatedEditFormName($value){
        $this->editForm['slug'] = Str::slug($value);
    }

    public function mount(Category $category){
        $this->category = $category;
        $this->getSubcategories();
    }

    public function getSubcategories(){
        $this->subcategories = Subcategory::where('category_id', $this->category->id)->get();
    }

    public function save(){
        $this->validate();
        $this->category->subcategories()->create($this->createForm);
        $this->reset('createForm');
        $this->getSubcategories();

    }

    public function edit(Subcategory $subcategory){

        $this->subcategory = $subcategory;
        $this->resetValidation();

        $this->editForm['open'] = true;

        $this->editForm['name'] = $subcategory->name;
        $this->editForm['slug'] = $subcategory->slug;

    }

    public function update(){
        $this->validate([
            'editForm.name' => 'required',
            'editForm.slug' => 'required|unique:subcategories,slug,' . $this->subcategory->id
        ]);

        $this->subcategory->update($this->editForm);
        $this->getSubcategories();
        $this->reset('editForm');
    }

    public function delete(Subcategory $subcategory){
        $subcategory->delete();
        $this->getSubcategories();
    }

    public function render()
    {
        return view('livewire.admin.show-category')->layout('layouts.admin');
    }
}
