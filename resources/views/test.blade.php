<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Sách</title>
</head>
<body>
    <h2>📚 Danh sách Sách trong CSDL</h2>

    @if(count($sachs) > 0)
        <table border="1" cellpadding="6" cellspacing="0">
            <tr style="background-color:#f0f0f0;">
                <th>Mã Sách</th>
                <th>Tên Sách</th>
                <th>Tóm Tắt</th>
                <th>Số Lượng</th>
                <th>Mã VT</th>
            </tr>
            @foreach($sachs as $sach)
                <tr>
                    <td>{{ $sach->MaSach }}</td>
                    <td>{{ $sach->TenSach }}</td>
                    <td>{{ $sach->TomTat }}</td>
                    <td>{{ $sach->SoLuong }}</td>
                    <td>{{ $sach->MaVT }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Không có dữ liệu trong bảng Sach.</p>
    @endif
</body>
</html>
