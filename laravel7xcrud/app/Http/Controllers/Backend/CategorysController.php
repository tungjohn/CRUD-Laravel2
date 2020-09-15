<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\CategorysModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategorysController extends Controller
{
    //

    public function index(Request $request)
    {
        $searchKeyword = $request->query('category_name', '');
        $sort = $request->query('category_sort', '');
        $queryORM = CategorysModel::where('name', 'LIKE', "%".$searchKeyword."%");
        

        if ($sort == 'name_asc')
        {
            $queryORM = $queryORM->orderBy('name', 'asc');
        }
        if ($sort == 'name_desc')
        {
            $queryORM = $queryORM->orderBy('name', 'desc');
        }
        $categorys = $queryORM->paginate(5);
        $data = [];
        $data['categorys'] = $categorys;
        $data['searchKeyword'] = $searchKeyword;
        $data['sort'] = $sort;
        return view('backend.category.index', $data);
    }
    public function create()
    {
        return view('backend.category.create');
    }

    public function edit($id)
    {
        $category = CategorysModel::findOrFail($id);
        $data = [];
        $data['category'] = $category;
        return view('backend.category.edit', $data);
    }

    public function delete($id)
    {
        $category = CategorysModel::findOrFail($id);
        $data = [];
        $data['category'] = $category;
        return view('backend.category.delete', $data);
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'desc' => 'required',
            'image' => 'required',
            
        ]);

        $name = $request->input('name', '');
        $slug = $request->input('slug', '');
        $pathCategoryImage = $request->file('image')->store('public/categoryimage');
        
        $desc = $request->input('desc', '');
        $parent_id = 0;
        $category = new CategorysModel();

        $category->name = $name;
        $category->slug = $slug;
        $category->image = $pathCategoryImage;
        $category->desc = $desc;
        $category->parent_id = $parent_id;

        $category->save();

        return redirect('backend/category/index')->with('status', 'Thêm danh mục thành công');
    }
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'desc' => 'required',
            
        ]);

        $name = $request->input('name', '');
        $slug = $request->input('slug', '');
        $desc = $request->input('desc', '');
        
        $category = CategorysModel::findOrFail($id);
        
        $category->name = $name;
        $category->slug = $slug;
        $category->desc = $desc;
        

        if ($request->hasFile('image'))
        {
            if ($category->image)
            {
                Storage::delete($category->image);
            }
            $pathCategoryImage = $request->file('image')->store('public/categoryimage');
            $category->image = $pathCategoryImage;
        }
        
        $category->save();

        return redirect('backend/category/index')->with('status', 'Cập nhật danh mục thành công');

    }
    public function destroy($id)
    {
        /* Ngăn chặn xóa danh mục đang chứa sản phẩm, chỉ cho phép xóa những danh mục rỗng  */
        $countProducts = DB::table('products')->where('category_id', $id)->count();

        if ($countProducts > 0) {
            return redirect('/backend/category/index')->with('status', 'Xóa tất cả các sản phẩm thuộc danh mục này trước khi xóa danh mục!');
        }
        $category = CategorysModel::findOrFail($id);

        $category->delete();

        return redirect('backend/category/index')->with('status', 'Xóa danh mục thành công');
    }
}
