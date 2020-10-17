<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductsModel; //nạp namespace cho model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //nạp namespace của DB (phân trang)
use Illuminate\Support\Facades\Storage; //nạp namespace của Storage (xóa file image đã lưu)
class ProductsController extends Controller
{
    //
    public function home() {
        return view('backend.dashboard.home');
    }
    public function index(Request $request) {
        /* Lấy giá trị người dùng nhập vào ô search */
        //vì trong form để là phương thức get nên sử dụng method $request->query('name', 'giá trị mặc định') để lấy giá trị
        $searchKeyword = $request->query('product_name', '');

        /* Lấy giá trị người dùng nhập vào ô trạng thái, mặc định là "rỗng", ép kiểu số nguyên */
        $productStatus = (int) $request->query('product_status', "");

        /* Khai báo mảng chứa các giá trị của ô trạng thái */
        $allProductStatus = [1,2];

        /* Lấy giá trị người dùng nhập vào ô sort */
        $sort = $request->query('product_sort', "");
        $category_sort = (int) $request->query('category_sort', '');
        /* gán biến queryORM = câu truy vấn */
        //ProductsModel::where('tên cột', 'Toán tử', 'giá trị cần truy vấn')
        $queryORM = ProductsModel::where('product_name', "LIKE", "%".$searchKeyword."%");

        /* Thêm dần các query vào phần truy vấn */
        //kiểm tra nếu giá trị product_status nằm trong các giá trị của mảng allProductStatus
        if (in_array($productStatus, $allProductStatus))
        {
            //Thêm query truy vấn trạng thái vào phần truy vấn (biến $queryORM)
            $queryORM = $queryORM->where('product_status', $productStatus);
        }

        if ($category_sort)
        {
            $queryORM = $queryORM->where('category_id', $category_sort);
        }

        if ($sort == 'price_asc')
        {
            $queryORM = $queryORM->orderBy('product_price', 'asc');
        }
        if ($sort == "price_desc")
        {
            $queryORM = $queryORM->orderBy('product_price', 'desc');
        }
        if ($sort == 'quantity_asc')
        {
            $queryORM = $queryORM->orderBy('product_quantity', 'asc');
        }
        if ($sort == 'quantity_desc')
        {
            $queryORM = $queryORM->orderBy('product_quantity', 'desc');
        }

        
        

        //ProductsModel::all() lấy tất cả các bản ghi trong mảng
        //$products = ProductsModel::all();

        //Phân trang khi có quá nhiều dữ liệu: DB::table('tên bảng')->paginate(số bản ghi mỗi bảng)
        //dùng {{ $products->links()}} để hiển thị thanh phân trang ở file view
        //$products = DB::table('products')->paginate(10);
        
        /* thực hiện câu truy vấn query, kèm phân trang dữ liệu */
        $products = $queryORM->paginate(10);
        /* lấy dữ liệu từ table 'categorys' truyền xuống view */
        $categories = DB::table('categorys')->get();
        
        /* truyền dữ liệu xuống view */
        $data = [];
        $data['products'] = $products;
        $data['searchKeyword'] = $searchKeyword;
        $data['productStatus'] = $productStatus;
        $data['sort'] = $sort;
        $data['categories'] = $categories;
        $data['category_sort'] = $category_sort;
        return view('backend.products.index', $data);
    }
    public function create() {
        $categories = DB::table('categorys')->get();
        $data = [];
        $data['categories'] = $categories;
        return view('backend.products.create', $data);
    }
    public function edit($id) {

        $product = ProductsModel::findOrFail($id);
        $categories = DB::table('categorys')->get();
        $data = [];
        $data['product'] = $product;
        $data['categories'] = $categories;
        return view('backend.products.edit', $data);
    }
    public function delete($id) {
        $product = ProductsModel::findOrFail($id);
        $data = [];
        $data['product'] = $product;
        return view('backend.products.delete', $data);
    }

    /* CREAT */

    public function store(Request $request) {
        //validate dữ liệu
        $validateData = $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_quantity' => 'required',
            'product_price' => 'required',
            'product_image' => 'required',
            'product_status' => 'required',
            'category_id' => 'required'
        ]);


        $product_name = $request->input('product_name', '');
        $product_desc = $request->input('product_desc', '');
        $product_publish = $request->input('product_publis', '');
        $product_quantity = $request->input('product_quantity', 0);
        $product_price = $request->input('product_price', 0);
        $category_id = $request->input('category_id', '');
        /* UPLOAD FILES */
        //$request->file('product_image'): lấy file được upload lên từ phương thức file() của đối tượng $request
        //store('public/productimages'): truyền đường dẫn muốn lưu file vào trong phương thức store (Mặc định các file upload lên sẽ được lưu vào đường dẫn sau : (storage/app)
        //Nên chỉ cần truyền thêm đường dẫn folder bên trong thư mục này mà chúng ta muốn lưu vào mà thôi

        $pathProductimage = $request->file('product_image')->store('public/productimages');
        $product_status = $request->input('product_status', 1);
        //Khởi tạo model của product trong phương thức store() :
        $product = new ProductsModel();
        
        // khi $product_publish không được nhập dữ liệu

        //  gán giá trị là thời gian hiện tại theo định dạng Y-m-d H:i:s
        if (!$product_publish)
        {
            $product_publish = date('Y-m-d H:i:s');
        }

        // gán dữ liệu từ request cho các thuộc tính của biến $product
        // $product là đối tượng khởi tạo từ model ProductsModel
        //$product properties phải trùng tên với tên cột trong table
        $product->product_name = $product_name;
        $product->product_desc = $product_desc;
        $product->product_publish = $product_publish;
        $product->product_quantity = $product_quantity;
        $product->product_price = $product_price;
        $product->product_status = $product_status;
        $product->product_image = $pathProductimage;
        $product->category_id = $category_id;
        // lưu sản phẩm
        
        $product->save(); 
        // ->with('Tên_biến', ''giá trị') 
        return redirect('/backend/product/index')->with('status', 'Thêm sản phẩm thành công!');
    }

    /* UPDATE */
    public function update(Request $request, $id) {
        $validateData = $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_quantity' => 'required',
            'product_price' => 'required',
            'product_status' => 'required',
            'category_id' => 'required'
        ]);
           
        $product_name = $request->input('product_name', '');
        $product_status = $request->input('product_status', 1);
        $product_desc = $request->input('product_desc', '');
        $product_publish = $request->input('product_publish', '');
        $product_quantity = $request->input('product_quantity', 0);
        $product_price = $request->input('product_price', 0);
        $category_id = $request->input('category_id', '');
        
        $product = ProductsModel::findOrFail($id);

        if (!$product_publish) {
            $product_publish = date('Y-m-d H:i:s');
        }
        
        $product->product_name = $product_name;
        $product->product_status = $product_status;
        $product->product_desc = $product_desc;
        $product->product_publish = $product_publish;
        $product->product_quantity = $product_quantity;
        $product->product_price = $product_price;
        $product->category_id = $category_id;
        /* UPLOAD ẢNH */
        if ($request->hasFile('product_image'))
        {
            // nếu có ảnh mới upload lên và
            // trong biến $product->product_image có dữ liệu
            // có nghĩa là trước đó đã có ảnh trong db
            if ($product->product_image)
            {
                //câu lệnh để xóa file (phải nạp namespace của Storage vào đầu class ProductsController)
                Storage::delete($product->product_image);
            }
            $pathProductimage = $request->file('product_image')->store('public/productimages');
            $product->product_image = $pathProductimage;
        }
        $product->save();

        return redirect('/backend/product/edit/'.$id)->with('status', 'Cập nhật sản phẩm thành công!');
    }

    public function remove($id) {
        $product = ProductsModel::findOrFail($id);
        $product->delete();
        return redirect('/backend/product/index')->with('status', 'Xóa sản phẩm thành công');
    }
}
