<script>

        $(document).ready(function () {
            // hàm updateCart
            function updateCart() {
                //gán biến total=0
                var total = 0;
                //duyệt qua các dòng input số lượng sản phẩm trong giỏ hàng
                $("input[name='product_quatity[]']").each(function (index, value) {
                    //in ra console thứ tự trong giỏ hàng
                    console.log(index);
                    //in ra console số lượng từng sản phẩm
                    console.log(value);
                    //gán t = dòng input số lượng sản phẩm trong giỏ hàng
                    var t = $(this);
                    //gán tr = dòng chứa sản phẩm
                    var tr = t.closest("tr");
                    //gán quantity = số lượng của sản phẩm 
                    var quantity = t.val();
                    //gán price = giá sản phẩm
                    var price = tr.find("td.product_price").text();
                    //làm tròn price
                    price = parseFloat(price);
                    //gán tt = số lượng * giá 
                    var tt = quantity*price;
                    //in ra console các biến quantity, price, tt
                    console.log(quantity);
                    console.log(price);
                    console.log(tt);
                    //in ra trong giỏ hàng ô tổng giá trị của sản phẩm = biến tt
                    tr.find("td.product_price_total").text(tt);
                    //khi tổng giá trị mỗi sản phẩm thay đổi thì cập nhật lại tổng giá trị đơn hàng
                    total += tt;
                });
                //in ra trong giỏ hàng tổng giá trị của đơn hàng bằng biến total
                $("#payment-price").text(total);


            }
           //function tìm sản phẩm (ajax)
           $('#search_product').select2({
               //placeholder trong ô tìm kiếm
                placeholder: 'Tìm 1 sản phẩm',
                //object ajax
                ajax: {
                    //kiểu truyền dữ liệu đến server: POST
                   type:'POST',
                    // data: dữ liệu truyền lên server:
                   data:function (params) {
                        //truyền biến query lên server (bao gồm dữ liệu trong ô search_product và token bảo mật)
                       query = {
                            //dữ liệu trong ô search_product
                           search: params.term,
                            //dữ liệu _token (gửi token)
                           _token: "{{ csrf_token() }}"

                       };
                        //trả về query
                       return query;

                   },
                    //địa chỉ server truyền dữ liệu
                    url: "{{ url('/backend/orders/searchProduct') }}",
                    //sau khi hoàn tất truyền dữ liệu thì trả về data
                    processResults: function (data) {
                    
                       console.log(data);

                       return data;
                   }
               }
           });
           // khi nút #addtocart được click thì trả về function
            $("#addtocart").on("click", function (e) {
                //tạm dừng hành động chuyển trang
                e.preventDefault();
                //gán biến id = giá trị trong ô #search_product
                var id = $('#search_product').val();
                //ép kiểu id về số nguyên
                id = parseInt(id);
                //nếu id > 0 (người dùng đã chọn sản phẩm)
                if (id > 0) {
                    //bắt đầu thực hiện kỹ thuật ajax
                    $.ajax({
                        //kiểu truyền dữ liệu lên server: POST
                        method: "POST",
                        //địa chỉ server truyền dữ liệu
                        url: "{{ url('/backend/orders/ajaxSingleProduct') }}",
                        // data: dữ liệu truyền lên server:
                        // id: biến id
                        // _token: token bảo mật
                        data: { id: id,_token: "{{ csrf_token() }}" }
                        // sau khi dữ liệu được gửi đến server, gọi function(product) (product là dữ liệu được trả về)
                    }).done(function( product ) {

                        console.log(product);
                        // gán biến checkTr = độ dài của thẻ có id là tr-+product.id 
                        checkTr = $("tbody#list-cart-product").find("#tr-"+product.id).length;
                        // ép kiểu biến checkTr về số nguyên
                        checkTr = parseInt(checkTr);
                        //nếu id sản phẩm có trả về dữ liệu và số lượng sản phẩm trong data>0 (vẫn còn sản phẩm trong kho), và checkTr<1 (sản phẩm chưa có trong giỏ hàng)
                        if (product.id !== "undefined" && product.product_quantity > 0 && checkTr < 1) {
                            //gán biến html = dữ liệu hiển thị trong giỏ hàng
                            var html = '<tr id="tr-'+product.id+'">\n' +
                                '                        <td>\n' +
                                '                            \n' + product.id +
                            '                            <input type="hidden" name="product_ids[]" class="form-control" style="width: 150px" value="'+product.id+'">\n' +
                            '                        </td>\n' +
                            '                        <td><img src="'+product.product_image+'" style="width: 100px; height: auto;"> </td>\n' +
                            '                        <td>'+product.product_name+'</td>\n' +
                            '                        <td>\n' +
                            '                            <input type="number" name="product_quatity[]" class="form-control" style="width: 150px" value="1">\n' +
                            '                        </td>\n' +
                            '                        <td class="product_price">\n' +
                            product.product_price +
                            '\n' +
                            '                        </td>\n' +
                            '                        <td class="product_price_total">\n' +
                                product.product_price +
                                '                        </td>\n' +
                            '\n' +
                            '                        <td>\n' +
                            '                            <a href="#" class="btn btn-danger removeCart">Xóa</a>\n' +
                            '                        </td>\n' +
                            '                    </tr>';
                            //hiển thị dữ liệu trong giỏ hàng
                            $( "tbody#list-cart-product" ).append( html );
                            //gọi hàm updateCart() để update dữ liệu trong giỏ hàng
                            updateCart();
                            //ngoài ra
                        } else {
                            //hiển thị thông báo lỗi
                            alert("thêm sản phẩm không thành công do đã có sp trong giỏ hàng hoặc lỗi hệ thống");
                        }

                    });
                    //ngoài ra nếu người dùng chưa chọn sp
                } else {
                    //hiển thị thông báo lỗi
                    alert("chọn sản phẩm trước khi thêm nó vào đơn hàng");
                }
                //hiển thị ra màn hình console biến id
                console.log(id);
            });
            //khi click vào nút remove trong giỏ hàng
            $("body").on("click", "a.removeCart", function (e) {
                //ngưng sự kiện
                e.preventDefault();
                //xóa dòng sản phẩm chứa nút remove vừa click
                $(this).closest("tr").remove();
                //chạy hàm updateCart để update lại giỏ hàng
                updateCart();
            });
            //khi số lượng sản phẩm trong giỏ hàng thay đổi
            $("body").on("change", "input[name='product_quatity[]']", function () {
                //gán biến quantity = số lượng sản phẩm trong giỏ hàng
                var quantity = $(this).val();
                //ép kiểu biến quantity về số nguyên
                quantity = parseInt(quantity);
                //nếu số lượng sản phẩm >0 hoặc <100
                if (quantity > 0 && quantity < 100) {
                    //chạy hàm updateCart để update lại giỏ hàng
                    updateCart();
                    //ngoài ra
                } else {
                    //chuyển giá trị trong ô số lượng sản phẩm về 1
                    $(this).val(1);
                    //alert thông báo lỗi
                    alert("chỉ được mua số lượng (1 đến 99)/một sản phẩm");
                    //chạy lại hàm updatecart
                    updateCart();
                }

            });
        });
    </script>