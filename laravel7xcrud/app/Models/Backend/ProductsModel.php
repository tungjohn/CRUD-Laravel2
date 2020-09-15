<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

/* Các model thông thường sẽ kế thừa từ class Model thuộc namespace Illuminate\Database\Eloquent\Model

    Model trong laravel cho phép chúng ta có thể tương tác với 1 bảng trong CSDL và có thể thêm sửa xóa , lấy ra dữ liệu trong bảng đó mà không phải viết các câu SQL để truy vấn. Nói chung là sẽ nhanh hơn việc code SQL để truy vấn dữ liệu cho mục đích thêm sửa xóa ...
    Nếu bạn đặt tên khóa chính khác id thì nên khai báo khóa chính, Hoặc khai báo khóa chính là id cũng được không sao
*/
class ProductsModel extends Model
{
    //khai báo tên bảng mà model ProductsModel sẽ tương tác
    protected $table = 'products'; 
    //Khai báo khóa chính của mảng

    protected $primaryKey = 'id';
}
