<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;
use Livewire\WithPagination;

class MenuTable extends Component
{
    use WithPagination;
    public $isModalShow = false;
    public $isConfirmationModal = false;
    public $deleteId;
    public $deleteName;
    public $isEdit = false;
    public $editId;
    public $name;
    public $category;
    public $price;
    public $filterCategory = null;

    public function render()
    {
        $menus = Menu::where('category', 'like', '%' . $this->filterCategory . '%')->paginate(5);
        return view('livewire.menu-table', [
            'menus' => $menus
        ]);
    }

    public function setFilter($category)
    {
        $this->filterCategory = $category;
    }

    public function setModalEdit($id)
    {
        $menu = Menu::findOrFail($id);

        $this->isModalShow = true;
        $this->isEdit = true;
        $this->editId = $id;

        $this->name = $menu->name;
        $this->category = $menu->category;
        $this->price = (int) $menu->price;
    }

    public function showConfirmationDelete($id, $name)
    {
        $this->isConfirmationModal = true;
        $this->deleteId = $id;
        $this->deleteName = $name;
    }

    public function closeConfirmationDelete()
    {
        $this->isConfirmationModal = false;
        $this->reset('deleteId', 'deleteName');
    }

    public function setModalClose()
    {
        $this->isModalShow = false;
        $this->isEdit = false;
        $this->reset('editId', 'name', 'category', 'price');
    }

    public function storeMenu()
    {
        $validated = $this->validate([
            'name' => 'required|unique:menus',
            'category' => 'required',
            'price' => 'required|integer'
        ]);

        Menu::create($validated);

        $this->setModalClose();

        toastr()->success('New menu successfully added');
    }

    public function updateMenu()
    {
        $validated = $this->validate([
            'name' => 'required|unique:menus,name,' . $this->editId,
            'category' => 'required',
            'price' => 'required|integer'
        ]);

        $menu = Menu::findOrFail($this->editId);
        $menu->name = $validated['name'];
        $menu->category = $validated['category'];
        $menu->price = $validated['price'];

        $menu->save();

        $this->setModalClose();

        toastr()->success('Menu successfully updated');
    }

    public function deleteMenu()
    {
        $menu = Menu::findOrFail($this->deleteId);
        $menu->delete();

        $this->closeConfirmationDelete();

        toastr()->success('Menu successfully deleted');
    }
}
