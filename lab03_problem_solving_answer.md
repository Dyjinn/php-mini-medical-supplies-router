# Câu 2 - Problem Solving

Ứng dụng em chọn ở Câu 1 là **Mini Medical Supplies Routing App**. Hệ thống quản lý danh sách vật tư y tế mẫu như khẩu trang y tế, gạc tiệt trùng, nhiệt kế điện tử và ống tiêm dùng một lần.

## 1. Vì sao cần Front Controller?

Cần Front Controller vì mọi request nên có một điểm vào thống nhất. Trong bài của em, mọi request đều đi qua `public/index.php` khi chạy bằng lệnh:

```bash
php -S localhost:8000 -t public public/index.php
```

Nếu không dùng Front Controller, project có thể bị chia thành nhiều file như `home.php`, `supplies.php`, `login.php`, `health.php`. Mỗi file tự xử lý một URL riêng làm cho URL không nhất quán, khó kiểm soát lỗi 404/405, khó thêm logging hoặc kiểm tra đăng nhập sau này.

Trong bài của em, `public/index.php` làm các nhiệm vụ chính:

- nạp autoload;
- tạo đối tượng `Router`;
- khai báo các route như `GET /supplies`, `POST /supplies`, `GET /health`;
- đọc `REQUEST_METHOD` và `REQUEST_URI`;
- gọi `$router->dispatch($method, $path)`.

Không nên viết trực tiếp logic xử lý vật tư y tế, validate form, render HTML dài hoặc xử lý login thật trong `public/index.php`. Những phần đó nên để trong controller như `SupplyController`, `AuthController`.

## 2. Router giải quyết vấn đề gì?

Router giúp map URL và HTTP method đến đúng controller/action. Công thức là:

```text
METHOD + PATH -> Controller@Action
```

Ví dụ trong bài của em:

```text
GET /supplies          -> SupplyController@index
GET /supplies/create   -> SupplyController@create
POST /supplies         -> SupplyController@store
GET /health            -> HealthController@index
GET /login             -> AuthController@login
POST /login            -> AuthController@handleLogin
GET /logout            -> AuthController@logout
```

Nhờ Router, khi muốn thêm route mới, em chỉ cần khai báo thêm trong `public/index.php`, không cần tạo nhiều file PHP rời rạc.

## 3. Vì sao phải phân biệt 404 và 405?

`404 Not Found` nghĩa là đường dẫn không tồn tại trong danh sách route. Ví dụ:

```text
GET /unknown -> 404 Not Found
```

Trong bài của em, `/unknown` không được khai báo nên Router trả 404.

`405 Method Not Allowed` nghĩa là URL có tồn tại nhưng method gọi sai. Ví dụ:

```text
POST /health -> 405 Method Not Allowed
Allow: GET
```

Trong bài của em, `/health` có route nhưng chỉ hỗ trợ `GET /health`, không hỗ trợ `POST /health`. Vì vậy Router trả 405 và kèm header `Allow: GET`.

## 4. Vì sao cần chuẩn hoá response?

Hệ thống của em trả nhiều loại response:

- HTML response: dùng cho `GET /`, `GET /supplies`, `GET /supplies/create`, `GET /login`.
- JSON response: dùng cho `GET /health` để Postman hoặc hệ thống khác đọc trạng thái hệ thống.
- Redirect response: dùng cho `GET /go-home`, `GET /logout`, `POST /login`, `POST /supplies` sau khi submit form thành công.
- 404 response: dùng khi path không tồn tại như `/unknown`.
- 405 response: dùng khi path có tồn tại nhưng method sai như `POST /health`.

Không nên lúc nào cũng `echo` text hoặc luôn trả `200 OK`, vì client sẽ hiểu sai kết quả. Ví dụ `POST /health` nếu trả 200 thì người test tưởng route này hợp lệ, trong khi thực tế hệ thống chỉ cho phép GET.

## 5. Vì sao nên tổ chức controller theo nhóm chức năng?

Trong bài của em, controller được chia như sau:

- `HomeController`: xử lý trang chủ và redirect `/go-home`.
- `HealthController`: xử lý health check JSON.
- `SupplyController`: xử lý danh sách vật tư y tế, form tạo vật tư và submit form.
- `AuthController`: xử lý login/logout demo.

Nếu gom hết vào một controller lớn, file đó sẽ nhanh dài, khó đọc, khó sửa và dễ gây lỗi khi mở rộng thêm CRUD, database hoặc phân quyền. Chia controller theo nhóm giúp project dễ bảo trì hơn.

## 6. Vì sao URL cần được chuẩn hoá?

URL trong bài của em được viết thường, ngắn gọn, dễ đọc và nhất quán:

```text
/supplies
/supplies/create
/health
/login
/logout
/go-home
```

`/supplies` dùng danh từ số nhiều để biểu diễn tài nguyên vật tư y tế. `/supplies/create` biểu diễn trang tạo vật tư. Các URL này dễ nhớ và dễ mở rộng.

URL chưa tốt là:

```text
/showAllSuppliesNow
/SupplyCreatePage
/doLoginPHP
```

Các URL này dài, lẫn chữ hoa, mang tính hành động hoặc gắn với công nghệ PHP, nên khó bảo trì và không nhất quán.

## 7. Nếu hệ thống tiếp tục phát triển, cần cải tiến phần nào?

Nếu phát triển thành hệ thống thật, em nên ưu tiên các phần sau:

1. Lưu dữ liệu bằng database thay vì array PHP, vì vật tư y tế cần được thêm, sửa, xoá và lưu lâu dài.
2. Thêm CRUD đầy đủ: xem chi tiết, cập nhật số lượng tồn, xoá vật tư hết dùng.
3. Thêm validation tốt hơn: đơn giá phải là số dương, số lượng không âm, mã vật tư không được trùng.
4. Thêm session/login thật để phân biệt nhân viên kho, quản lý và người xem.
5. Thêm middleware kiểm tra đăng nhập để chỉ người hợp lệ mới được tạo hoặc cập nhật vật tư.
6. Thêm layout/template chung để không lặp lại menu HTML ở nhiều view.
7. Thêm dynamic route như `/supplies/1` để xem chi tiết từng vật tư y tế.

Các cải tiến này gắn trực tiếp với bài toán vật tư y tế vì dữ liệu kho cần chính xác, có phân quyền và có khả năng mở rộng.
