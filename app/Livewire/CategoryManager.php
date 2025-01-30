<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryManager extends Component
{
    public $categories, $name, $category_id;
    public $isOpen = false;

    public function render()
    {
        $this->categories = Category::where('user_id', Auth::id())->get();
        return view('livewire.category-manager');
    }

    public function create()
    {
        $this->validate(['name' => 'required']);

        Category::create([
            'name' => $this->name,
            'user_id' => Auth::id(),
        ]);

        $this->resetInputFields();
    }

    public function edit($id)
    {
        $category = Category::where('user_id', Auth::id())->findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->isOpen = true;
    }

    public function update()
    {
        $this->validate(['name' => 'required']);

        $category = Category::where('user_id', Auth::id())->findOrFail($this->category_id);
        $category->update(['name' => $this->name]);

        $this->resetInputFields();
    }

    public function delete($id)
    {
        Category::where('user_id', Auth::id())->where('id', $id)->delete();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->category_id = null;
        $this->isOpen = false;
    }
}
