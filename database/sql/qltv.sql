-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: db:3306
-- Thời gian đã tạo: Th1 06, 2026 lúc 01:29 PM
-- Phiên bản máy phục vụ: 8.0.44
-- Phiên bản PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qltv`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `muontra`
--

CREATE TABLE `muontra` (
  `MaMuon` int NOT NULL,
  `MaDocGia` varchar(37) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `NgayMuon` datetime NOT NULL,
  `HanTra` datetime NOT NULL,
  `NgayTra` datetime DEFAULT NULL,
  `TrangThai` enum('DangMuon','DaTra') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'DangMuon',
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `muontra`
--

INSERT INTO `muontra` (`MaMuon`, `MaDocGia`, `NgayMuon`, `HanTra`, `NgayTra`, `TrangThai`, `user_id`) VALUES
(1, 'DH52111178_NGUYENLEANHKIET_03.08.2003', '2025-12-22 17:16:01', '2025-12-29 00:00:00', '2025-12-22 18:02:19', 'DaTra', 1),
(2, 'DH52111178_NGUYENLEANHKIET_03.08.2003', '2025-12-22 17:16:16', '2025-12-29 00:00:00', '2025-12-28 19:29:49', 'DaTra', 1),
(3, 'DH52134567', '2025-12-22 17:27:36', '2025-12-29 00:00:00', '2025-12-28 19:29:59', 'DaTra', 1),
(4, 'DH52134567', '2025-12-22 18:03:40', '2025-12-29 00:00:00', '2025-12-28 19:30:03', 'DaTra', 1),
(5, 'DH52111178_NGUYENLEANHKIET_03.08.2003', '2025-12-28 19:30:29', '2026-01-04 00:00:00', '2026-01-04 06:46:27', 'DaTra', 1),
(6, 'DH52111178_NGUYENLEANHKIET_03.08.2003', '2026-01-04 06:50:33', '2026-01-11 00:00:00', '2026-01-04 06:58:57', 'DaTra', 1),
(7, 'DH52111178_NGUYENLEANHKIET_03.08.2003', '2026-01-04 08:07:30', '2026-01-11 00:00:00', '2026-01-04 08:21:28', 'DaTra', 1),
(8, 'DH52111178_NGUYENLEANHKIET_03.08.2003', '2026-01-04 08:22:23', '2026-01-11 00:00:00', '2026-01-04 08:22:37', 'DaTra', 1),
(9, 'DH52111178_NGUYENLEANHKIET_03.08.2003', '2026-01-04 08:23:35', '2026-01-11 00:00:00', NULL, 'DangMuon', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `muontra_chitiet`
--

CREATE TABLE `muontra_chitiet` (
  `id` int NOT NULL,
  `MaMuon` int NOT NULL,
  `ISBN13` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `muontra_chitiet`
--

INSERT INTO `muontra_chitiet` (`id`, `MaMuon`, `ISBN13`) VALUES
(2, 6, '9786043147735'),
(1, 6, '9786043177770'),
(3, 7, '9786044818795'),
(4, 7, '9786045855034'),
(5, 7, '9786045885239'),
(7, 8, '9786043351668'),
(6, 8, '9786043445589'),
(8, 8, '9786045844502'),
(10, 9, '9786043351668'),
(11, 9, '9786045844502'),
(9, 9, '9786046948506');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhaxuatban`
--

CREATE TABLE `nhaxuatban` (
  `ID` int NOT NULL,
  `TenNXB` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhaxuatban`
--

INSERT INTO `nhaxuatban` (`ID`, `TenNXB`) VALUES
(1, 'NXB Trẻ'),
(2, 'NXB Lao Động'),
(3, 'NXB Văn Hóa – Văn Nghệ'),
(4, 'NXB Tổng hợp TP.HCM');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach`
--

CREATE TABLE `sach` (
  `ISBN13` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenSach` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TomTat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `NguoiDich` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SoLuong` int DEFAULT NULL,
  `SoTrang` int NOT NULL,
  `NamXuatBang` int NOT NULL,
  `TrangThai` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaVT` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MaNXB` int DEFAULT NULL,
  `Anh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `sach`
--

INSERT INTO `sach` (`ISBN13`, `TenSach`, `TomTat`, `NguoiDich`, `SoLuong`, `SoTrang`, `NamXuatBang`, `TrangThai`, `MaVT`, `MaNXB`, `Anh`) VALUES
('9786043043303', 'Quẳng gánh lo đi và vui sống', 'Quẳng Gánh Lo Đi Và Vui Sống\r\n\r\nTác phẩm kinh điển về tự lực và phát triển bản thân\r\n\r\nCuốn sách “Quẳng Gánh Lo Đi Và Vui Sống” – Dale Carnegie khuyên bạn những cách để giảm thiểu lo lắng rất đơn giản như chia sẻ nó với người khác, tìm cách giải quyết vấn đề, quên tất cả những điều lo lắng nằm ngoài tầm tay,… Cố gắng thực hành những điều này hàng ngày và trong cuộc sống chắc hẳn bạn sẽ thành công, có thể, không được như bạn muốn, nhưng chỉ cần bớt đi một chút phiền muộn thì cuộc sống của bạn đã có thêm một niềm vui.\r\n\r\nCuốn sách gồm 8 phần chia sẻ những nội dung xoay quanh sự lo lắng, những câu chuyện có thật về kinh nghiệm chế ngự và nguyên tắc loại bỏ nỗi lo lắng. Theo đó, cuốn sách trình bày 6 Cách tránh mệt mỏi và lo lắng đồng thời nâng cao tinh thần và sức lực, hơn thế nữa là Phương pháp phân tích và giải quyết nỗi lo, Cách thức gạt bỏ nỗi lo bị chỉ trích, 7 Cách luyện tinh thần để sống thanh thản và hạnh phúc... Một nội dung lớn được đề cập và phân tích sâu sắc, đồng thời là phương châm ngắn gọn nhất mà chúng ta có thể áp dụng là: Phương cách tuyệt vời để chế ngự nỗi lo lắng là lấy niềm tin làm điểm tựa. Mỗi nội dung, chủ đề đều được minh họa bằng nhiều câu chuyện có thật.\r\n\r\nCuốn sách là tập hợp những công thức giải tỏa lo lắng hiệu quả và đã được thời gian kiểm chứng. Và có thể bạn sẽ không thấy điều gì mới mẻ, nhưng bạn sẽ nhận ra nhiều điều đã bị chúng ta bỏ quên. Vấn đề không phải là chúng ta không biết hay không hiểu, mà là chúng ta không hành động. Mục đích của cuốn sách này là kể lại, làm sáng tỏ, tôn vinh và phân tích dưới góc nhìn mới của thời đại về những chân lý căn bản đã có từ xa xưa, nhằm xây dựng niềm tin nơi bạn và giúp bạn tự tin áp dụng chúng.\r\n\r\nBìa theo ý tưởng các phiên bản hiện hành của cuốn này trên thị trường.\r\n\r\nVới nội dung về đề tài tự lực, phát triển bản thân, “Quẳng Gánh Lo Đi Và Vui Sống” phù hợp với độc giả phổ thông thích tìm hiểu về kỹ năng hóa giải lo lắng.\r\n\r\nCuốn sách thuộc tủ sách Kinh điển của Omega+\r\n\r\nTHÔNG TIN TÁC GIẢ:\r\n\r\nROBERT NEIL MacGREGOR (sinh năm 1946)\r\n\r\nDale Breckenridge Carnegie (24 tháng 11 năm 1888 – 1 tháng 11 năm 1955) là một nhà văn và nhà thuyết trình Mỹ và là người phát triển các lớp tự giáo dục, nghệ thuật bán hàng, huấn luyện đoàn thể, nói trước công chúng và các kỹ năng giao tiếp giữa mọi người. Ra đời trong cảnh nghèo đói tại một trang trại ở Missouri, ông là tác giả cuốn Đắc Nhân Tâm, được xuất bản lần đầu năm 1936, một cuốn sách thuộc hàng bán chạy nhất và được biết đến nhiều nhất cho đến tận ngày nay. Ông cũng viết một cuốn tiểu sử Abraham Lincoln, với tựa đề Lincoln con người chưa biết, và nhiều cuốn sách khác.\r\n\r\nCarnegie là một trong những người đầu tiên đề xuất cái ngày nay được gọi là đảm đương trách nhiệm, dù nó chỉ được đề cập tỉ mỉ trong tác phẩm viết của ông. Một trong những ý tưởng chủ chốt trong những cuốn sách của ông là có thể thay đổi thái độ của người khác khi thay đổi sự đối xử của ta với họ.\r\n\r\nTRÍCH ĐOẠN/ CÂU QUOTE HAY\r\n\r\nNgày hôm nay chính là tài sản quý giá nhất của chúng ta. Nó là tài sản duy nhất chúng ta chắc chắn có.\r\n\r\nTrên bàn làm việc của nhà văn John Ruskin có một hòn đá đơn sơ, trên đó nổi bậc một từ rõ nét: Ngày hôm nay. Tuy không có hòn đá như thế nhưng tôi đã dán một bài thơ lên tấm gương soi để mình có thể nhìn vào mỗi sáng. Đó là bài thơ của Kalidasa, nhà soạn kịch nổi tiếng người Ấn Độ.\r\n\r\nLỜI CHÀO NGÀY MỚI\r\n\r\nHãy sống trọn vẹn ngày hôm nay!\r\n\r\nVì đó chính là cuộc sống, cuộc sống thực sự\r\n\r\nMột ngày – Ôi thời gian ngắn ngủi!\r\n\r\nChứa trọn mọi điều sự thật đời ta:\r\n\r\nNiềm vui trưởng thành\r\n\r\nSự hãnh diện khi hành động\r\n\r\nNét rực rỡ của dung nhan.\r\n\r\nQuá khứ chỉ là một giấc mơ\r\n\r\nVà tương lai là một viễn ảnh.\r\n\r\nSống hết mình trong hiện tại là làm đẹp mỗi ngày qua\r\n\r\nVà biến mỗi ngày mai thành ngày chứa chan hy vọng …\r\n\r\nVì thế, để thoát khỏi những lo lắng, phiền muộn, điều đầu tiên bạn cần phải làm là:\r\n\r\n“Hãy đóng chặt những cánh cửa nặng nề dẫn đến quá khứ và tương lai. Hãy sống với ngày hôm nay, tận dụng tối đa 24 giờ quý giá của một ngày.”\r\n\r\nSao bạn không tự hỏi bản thân mình và đi tìm câu trả lời cho những câu hỏi sau:\r\n\r\n1/ Liệu tôi có đang lảng tránh cuộc sống hiện tại vì cứ mãi lo nghĩ cho tương lai hay mơ tưởng đến “một vườn hồng huyền ảo ở tít tận chân trời”.\r\n\r\n2/ Liệu tôi có làm u ám ngày hôm nay của mình bằng những hối tiếc về những điều đã qua?\r\n\r\n3/ Liệu mỗi sáng thức dậy, tôi có quyết tâm “sống trọn ngày hôm nay” để sử dụng triệt để 24 giờ mà cuộc sống đem đến cho tôi?\r\n\r\n4/ Liệu tôi có thể sống tốt hơn khi chọn cách “sống trong ngăn kín của hiện tại” này không?\r\n\r\nKhi nào tôi nên bắt đầu? Tuần sau?…. Ngày mai?…. Hay Hôm nay?', 'Bảo Trâm', 3, 312, 2024, 'Con', 'A22', 4, 'img_book/9786043043303.jpg'),
('9786043147735', 'AI - Công cụ nâng cao hiệu suất công việc', 'AI - Công Cụ Nâng Cao Hiệu Suất Công Việc\r\n\r\nCác nhà lãnh đạo ở khắp mọi nơi đang băn khoăn không biết tự động hóa và trí tuệ nhân tạo sẽ ảnh hưởng đến tổ chức của họ như thế nào và liệu rằng công việc của những thành viên trong nhóm, các quản lý, đồng nghiệp, bạn bè và gia đình cũng như của chính họ có bị thay đổi hoặc bị xóa bỏ hay không.\r\n\r\n- Những người lạc quan nói rằng máy móc sẽ giúp lực lượng lao động được tự do thực hiện những công việc có giá trị cao và sáng tạo hơn.\r\n\r\n- Những người bi quan dự đoán rằng nạn thất nghiệp sẽ gia tăng hoặc tận thế sẽ xảy ra và con người sẽ phải phục tùng robot.\r\n\r\nTất nhiên, cả những người lạc quan và những người bi quan đều có phần đúng và sai. Thông qua cuốn sách này, Jesuthasan và Boudreau cung cấp một cách tiếp cận toàn diện để chuyển đổi công việc, đồng thời cho phép các tổ chức, các cá nhân thích nghi và phát triển.\r\n\r\nHy vọng rằng các công cụ được đề cập tới trong cuốn sách sẽ cung cấp cho bạn một cách có cấu trúc, sắc thái hơn để dự đoán các lựa chọn, đưa ra các quyết định khó khăn và định hướng các vị trí việc làm được tái tạo trong tương lai.\r\n\r\nVề tác giả:\r\n\r\nRavin Jesuthasan là Giám đốc điều hành tại Willis Towers Watson và là nhà lãnh đạo tư tưởng toàn cầu được công nhận. Ông là thành viên của Ban chỉ đạo về Việc làm của Diễn đàn Kinh tế Thế giới và được công nhận là một trong 25 nhà tư vấn có ảnh hưởng nhất trên thế giới.\r\n\r\nJohn Boudreau là Giáo sư về Tổ chức Quản lý tại Trường Kinh doanh Marshall của Đại học Nam California. Ông đã xuất bản hơn 200 ấn phẩm và các bài viết của ông thường xuyên xuất hiện trên Harvard Business Review, Wall Street Journal, Fortune, Fast Company, BusinessWeek, Talent Management, CFO.com, và NPR.', 'Vũ Thị Hồng Ngân', 3, 296, 2023, 'Con', 'A33', NULL, 'img_book/9786043147735.jpg'),
('9786043177770', 'Người giàu có nhất thành Babylon', 'Người giàu có nhất thành Babylon\r\n\r\nTrước mắt bạn, tương lai đang trải rộng con đường dẫn tới những miền đất xa xôi đầy hứa hẹn. Trên con đường đó, bạn háo hức, mong muốn thực hiện nhiều ước mơ, dự định, khát khao… của riêng mình.\r\n\r\nĐể những nguyện vọng của mình được thực hiện, ít nhất bạn phải thành công về mặt tiền bạc. Quyển sách này sẽ giúp bạn biết cách vận dụng những nguyên lý quan trọng để phát triển tài chính. Hãy để cuốn sách dẫn dắt bạn đi từ một hoàn cảnh khó khăn, tiêu biểu là một cái túi lép xẹp, đến một cuộc sống đầy đủ và hạnh phúc, tiêu biểu là một túi tiền căng phồng, sung túc.\r\n\r\nKhi nói đến tiền bạc, chúng ta thường đề cập đến quy luật trọng trường và nó luôn phổ quát và bất biến trong mọi trường hợp. Trải qua thời gian dài và phát triển, quy luật này đã được trải nghiệm và đúc rút thành những bí quyết không chỉ đảm bảo cho bạn một túi tiền đầy, mà còn giúp cho bạn có một cuộc sống cân bằng để có thể phát triển mỹ mãn hơn những tiềm năng của bản thân trong các lĩnh vực khác của cuộc sống. Bởi trên thực tế, không ai có thể phủ nhận rằng sự dồi dào về vật chất có thể làm cho đời sống con người trở nên tốt đẹp hơn. Riêng trong lĩnh vực kinh doanh, sức mạnh tài chính là phương tiện chủ yếu để đo lường mức độ thành đạt của các doanh nhân.\r\n\r\nNgày nay, tiền bạc vẫn có những ảnh hưởng lớn đối với cuộc sống con người, cũng giống như cách đây năm ngàn năm nó đã chi phối mạnh mẽ cuộc sống của cư dân vương quốc Babylon, thúc đẩy họ tìm hiểu và nắm bắt các quy luật tạo ra tiền, nhằm có được một cuộc sống sung túc và sang trọng bậc nhất.\r\n\r\nNhững trang sách này sẽ đưa chúng ta trở lại vương quốc Babylon cổ đại, cái nôi nuôi dưỡng những nguyên lý cơ bản về tài chính mà giờ đây con người hiện đại đã kế thừa và vận dụng trên toàn thế giới.\r\n\r\nBáo chí nói về sách:\r\n\r\n“Sự thành công của Babylon đã tạo cảm hứng cho tác giả viết một loạt truyện ngụ ngôn để chứng minh cho những quy luật bất biến về tài chính và cách tạo dựng của cải. Chúng đã trở nên rất phổ biến và được các ngân hàng, công ty bảo hiểm, các công ty khác sử dụng để giáo dục về lợi ích của việc tiết kiệm và tạo động lực làm việc tích cực hơn.” – Cafebiz\r\n\r\n“Người giàu có nhất thành Babylon là món quà cho những ai đã bước vào thế giới kinh doanh hoặc những người còn hoang mang, do dự trong cách sử dụng tiền bạc.” – Doanh nhân Sài Gòn\r\n\r\n“Những trang sách trong cuốn sách \"Người giàu có nhất thành Babylon\" sẽ đưa chúng ta trở lại vương quốc Babylon cổ đại, cái nôi nuôi dưỡng những nguyên lý cơ bản về tài chính mà giờ đây con người hiện đại đã kế thừa và vận dụng trên toàn thế giới. Cuốn sách nói về những thành công, những thành quả đạt được của từng cá nhân sống trong thành Babylon cổ đại. Từ đó, giúp mọi người hiểu rõ hơn về vấn đề tài chính và cống hiến các kế sách và phương pháp làm giàu. Những bí quyết này giúp bạn đánh giá đúng giá trị của đồng tiền, và hướng dẫn bạn cách thực hành theo những nguyên lý tài chính”. – VnExpress\r\n\r\nNgười nổi tiếng nói gì về cuốn sách này:\r\n\r\n\"Khi còn trẻ, tôi đã xem cuốn sách kinh điển năm 1926 của George Samuel Clason -  Người giàu nhất ở Babylon, nơi đưa ra lời khuyên tài chính có giá trị được kể qua các truyện ngụ ngôn cổ. Tôi giới thiệu nó cho mọi người.\" - Anthony Robbins, tác giả của “Đánh thức con người phi thường trong bạn”\r\n\r\nVề tác giả:\r\n\r\nGeorge Samuel Clason (sinh ngày 17 tháng 11 năm 1874 - mất ngày 7 tháng 4 năm 1957) hay còn biết đến với tên gọi George S. Clason là một doanh nhân, nhà văn người Mỹ.\r\n\r\nGeorge Samuel Clason sinh tại Louisiana, bang Missouri, Mỹ. Ông tốt nghiệp trường Đại học ở Nebraska, sau đó phục vụ trong quân đội Hoa Kỳ suốt cuộc chiến tranh Mỹ-Tây Ban Nha. Ông là một doanh nhân thành đạt và là người có công thành lập công ty bản đồ Clason ở Denver, bang Colorado, Mỹ. Công ty này xuất bản tập bản đồ đường bộ đầu tiên của nước Mỹ và Canada.\r\n\r\nNăm 1926, ông xuất bản tập sách đầu tiên mở đầu cho một loạt các tập truyện ngắn nổi tiếng viết về cách thức tiết kiệm, và phát triển tài chính của những nhà kinh doanh. Ông đã xuất sắc vận dụng các câu chuyện có không khí của thời kì Babylon cổ để minh họa cho những vấn đề mà ông đưa ra. Những tập sách này đã được phổ biến với một số lượng lớn nhờ vào sự hỗ trợ của các ngân hàng và các công ty bảo hiểm trên toàn thế giới.', 'Võ Hưng Thanh', 3, 214, 2020, 'Con', 'B11', 2, 'img_book/9786043177770.jpg'),
('9786043177771', 'zxc', 'xczzxcxzc', 'zxcz', 3, 123, 123123, 'Con', 'B33', 2, 'img_book/9786043177771.jpg'),
('9786043351668', 'Đắc nhân tâm', 'Đắc nhân tâm của Dale Carnegie là quyển sách của mọi thời đại và một hiện tượng đáng kinh ngạc trong ngành xuất bản Hoa Kỳ. Trong suốt nhiều thập kỷ tiếp theo và cho đến tận bây giờ, tác phẩm này vẫn chiếm vị trí số một trong danh mục sách bán chạy nhất và trở thành một sự kiện có một không hai trong lịch sử ngành xuất bản thế giới và được đánh giá là một quyển sách có tầm ảnh hưởng nhất mọi thời đại.\r\n\r\nĐây là cuốn sách độc nhất về thể loại self-help sở hữu một lượng lớn người hâm mộ. Ngoài ra cuốn sách có doanh số bán ra cao nhất được tờ báo The New York Times bình chọn trong nhiều năm. Cuốn sách này không còn là một tác phẩm về nghệ thuật đơn thuần nữa mà là một bước thay đổi lớn trong cuộc sống của mỗi người.\r\n\r\nNhờ có tầm hiểu biết rộng rãi và khả năng ‘ứng xử một cách nghệ thuật trong giao  tiếp’ – Dale Carnegie đã viết ra một quyển sách với góc nhìn độc đáo và mới mẻ trong giao tiếp hàng ngày một cách vô cùng thú vị – Thông qua những mẫu truyện rời rạc nhưng lại đầy lý lẽ thuyết phục. Từ đó tìm ra những kinh nghiệm để đúc kết ra những nguyên tắc vô cùng ‘ngược ngạo’, nhưng cũng rất logic dưới cái nhìn vừa sâu sắc, vừa thực tế.\r\n\r\nHơn thế nữa, Đắc Nhân Tâm còn đưa ra những nghịch lý mà từ lâu con người ta đã hiểu lầm về phương hướng giao tiếp trong mạng lưới xã hội, thì ra, người giao tiếp thông minh không phải là người có thể phát biểu ra những lời hay nhất, mà là những người học được cách mỉm cười, luôn biết cách lắng nghe, và khích lệ câu chuyện của người khác.\r\n\r\nCuốn sách Đắc Nhân Tâm được chia ra làm 4 nội dung chính và mỗi phần cũng là một bài học về cuộc sống.\r\n\r\nPhần 1: Nghệ thuật ứng xử cơ bản\r\n\r\n- Không nên trách móc và than phiền, thù oán\r\n\r\n- Muốn lấy được mật ong thì không nên phá tổ\r\n\r\n- Trách móc một người nào đó là một việc dễ dàng. Thay vào đó, bạn hãy ngó lơ sự phán xét đó mà rộng lượng. Đồng thời tha thứ cho người đó và bỏ qua hết mọi chuyện thì mới đáng được tự hào.\r\n\r\n- Biết khen ngợi và nhận được ơn nghĩa của người khác mới là bí mật lớn nhất về phép cư xử.\r\n\r\n- Bạn cần phải biết khen ngợi và biết ơn người khác một cách thành thật nhất, chính là chìa khóa tạo nên tình nhân ái.\r\n\r\nPhần 2:\r\n\r\n- Bạn nên thật lòng quan tâm đến người khác\r\n\r\n- Mỉm cười đó là cách để tạo ấn tượng tốt nhất\r\n\r\n- Hay ghi nhớ lấy tên của người bạn đã và đang giao tiếp với bạn\r\n\r\n- Bạn nên lắng nghe và khuyến khích người khác để trở thành người có khả năng giao tiếp cao\r\n\r\n- Hãy nói về cái mà người khác để ý sẽ thu hút được người đó\r\n\r\nPhần 3: Cách hướng người khác làm theo suy nghĩ của mình\r\n\r\n- Không được để ra tranh cãi và cách giải quyết tốt nhất đó là không nên để nó xảy ra\r\n\r\n- Tôn trọng ý kiến của mọi người, không bao giờ được nói người khác sai\r\n\r\n- Thừa nhận được sai làm của mình, nếu phạm phải thì bạn cần phải thừa nhận điều đó\r\n\r\n- Bạn cần phải hỏi những câu hỏi cần thiết để họ trả lời bạn bằng tiếng vâng ngay lập tức\r\n\r\n- Khi nói chuyện bạn hãy để cho đối phương cảm nhận được họ làm chủ trong câu chuyện\r\n\r\n- Để nhận được sự hợp tác thì bạn cần phải để họ nghĩ họ là người đưa ra ý tưởng\r\n\r\n- Bạn cần phải đặt mình vào hoàn cảnh của họ để có thể hiểu hết về bản thân của họ\r\n\r\n- Bạn hãy đồng cảm với mong muốn của mọi người\r\n\r\n- Trong cuộc sống bạn hãy gợi lên sự cao thượng\r\n\r\n- Thân thiện trong giao tiếp đó chính là sử dụng mật ngọt để bắt đầu được câu chuyện\r\n\r\n- Bạn nên trình bày một cách rõ ràng và sinh động nhất\r\n\r\n- Trong cuộc sống bạn cần phải vượt lên được thử thách\r\n\r\n- Trước khi phê bình người khác bạn hãy khen ngợi người đó\r\n\r\n- Khi phê bình bạn nên phê bình một cách gián tiếp\r\n\r\n- Bạn nên khen ngợi người khác để có được một cuộc sống xứng đáng\r\n\r\n- Bạn nên mở đường cho người khác để khắc phục sai lầm\r\n\r\n- Bạn nên tôn vinh người khác khi nói chuyện\r\n\r\n- Trước khi phê bình người khác thì bạn nên nhìn nhận lại bản thân của mình\r\n\r\n- Thay vì ra lệnh cho người khác thì bạn hãy gợi ý cho họ\r\n\r\n- Trong mọi chuyện bạn nên giữ thể diện cho người khác\r\n\r\n- Bạn cần phải lưu ý những mối quan hệ của mình\r\n\r\nPhần 4: Chuyển hóa được con người và không tạo lên sự oán hận và chống đối\r\n\r\nBáo chí nhắc gì về “Đắc Nhân Tâm”\r\n\r\n“Nói đến sách nghệ thuật ứng xử thì không thể không nhắc đến \"Đắc nhân tâm\" của Dale Carnegie. Đây là một trong những cuốn sách gối đầu của nhiều thế hệ đi trước và ngày nay. Với chặng đường hơn 80 năm kể từ khi lần đầu được xuất bản, \"Đắc nhân tâm\" đã mang đến cho chúng ta bài học vô cùng giá trị đó là nghệ thuật ứng xử để được lòng người. \"Đắc nhân tâm\" là quyển sách nổi tiếng và bán chạy nhất và có mặt ở hàng trăm quốc gia khác nhau, và hơn thế nữa đây còn là quyển sách liên tục đứng đầu danh mục sách bán chạy nhất do thời báo NewYork Times bình chọn trọng suốt 10 năm liền.” – Cafebiz.vn, 3 cuốn sách nên đọc đi đọc lại trong đời để ngẫm về cuộc sống\r\n\r\n“Đắc Nhân Tâm – của tác giả Dale Carnegie là quyển sách nổi tiếng nhất, bán chạy nhất và có tầm ảnh hưởng nhất của mọi thời đại. Tác phẩm đã được chuyển ngữ sang hầu hết các thứ tiếng trên thế giới và có mặt ở hàng trăm quốc gia. Một khám phá rất thú vị dành cho các bậc phụ huynh khi đọc cuốn sách này là biết cách lắng nghe trò chuyện cùng con, cách trị chứng tè dầm của trẻ nhỏ, hay cách làm cho một đứa trẻ từ quậy phá thành ngoan ngoãn… Đó hẳn là những câu chuyện nuôi dạy trẻ rất đúng, rất hay, rất đời thường đáng để bạn đọc suy ngẫm và chiêm nghiệm”. – Motthegioi.vn, Đắc nhân tâm: ‘Cha đã quên’ nhắc những điều nên nhớ\r\n\r\n“Đắc Nhân Tâm” đưa ra những lời khuyên về cách cư xử, ứng xử và giao tiếp với mọi người để đạt được thành công trong cuộc sống. Đây được coi là một trong những cuốn sách nổi tiếng nhất, bán chạy nhất và có tầm ảnh hưởng nhất mọi thời đại mà bạn không nên bỏ qua.” – Cafef.vn, 20 câu nói vàng đáng nhớ từ tuyệt tác để đời “Đắc Nhân Tâm”\r\n\r\nVề tác giả\r\n\r\nDale Breckenridge Carnegie (24 tháng 11 năm 1888 – 1 tháng 11 năm 1955) là một nhà văn và nhà thuyết trình Mỹ và là người phát triển các lớp tự giáo dục, nghệ thuật bán hàng, huấn luyện đoàn thể, nói trước công chúng và các kỹ năng giao tiếp giữa mọi người. Ra đời trong cảnh nghèo đói tại một trang trại ở Missouri, ông là tác giả cuốn Đắc Nhân Tâm, được xuất bản lần đầu năm 1936, một cuốn sách thuộc hàng bán chạy nhất và được biết đến nhiều nhất cho đến tận ngày nay. Ông cũng viết một cuốn tiểu sử Abraham Lincoln, với tựa đề Lincoln con người chưa biết, và nhiều cuốn sách khác.\r\n\r\nCarnegie là một trong những người đầu tiên đề xuất cái ngày nay được gọi là đảm đương trách nhiệm, dù nó chỉ được đề cập tỉ mỉ trong tác phẩm viết của ông. Một trong những ý tưởng chủ chốt trong những cuốn sách của ông là có thể thay đổi thái độ của người khác khi thay đổi sự đối xử của ta với họ.', 'Nguyễn Văn Phước', 1, 320, 2021, 'Het', 'A11', 1, 'img_book/9786043351668.jpg'),
('9786043445589', 'Đọc Vị Bất Kỳ Ai', 'Bạn băn khoăn không biết người ngồi đối diện đang nghĩ gì? Họ có đang nói dối bạn không? Đối tác đang ngồi đối diện với bạn trên bàn đàm phán đang nghĩ gì và nói gì tiếp theo?\r\n\r\nĐỌC người khác là một trong những công cụ quan trọng, có giá trị nhất, giúp ích cho bạn trong mọi khía cạnh của cuộc sống. ĐỌC VỊ người khác để:\r\n\r\nHãy chiếm thế thượng phong trong việc chủ động nhận biết điều cần tìm kiếm - ở bất kỳ ai bằng cách “thâm nhập vào suy nghĩ” của người khác. ĐỌC VỊ BẤT KỲ AI là cẩm nang dạy bạn cách thâm nhập vào tâm trí của người khác để biết điều người ta đang nghĩ. Cuốn sách này sẽ không giúp bạn rút ra các kết luận chung về một ai đó dựa vào cảm tính hay sự võ đoán. Những nguyên tắc được chia sẻ trong cuốn sách này không đơn thuần là những lý thuyết hay mẹo vặt chỉ đúng trong một số trường hợp hoặc với những đối tượng nhất định. Các kết quả nghiên cứu trong cuốn sách này được đưa ra dựa trên phương pháp S.N.A.P - cách thức phân tích và tìm hiểu tính cách một cách bài bản trong phạm vi cho phép mà không làm mếch lòng đối tượng được phân tích. Phương pháp này dựa trên những phân tích về tâm lý, chứ không chỉ đơn thuần dựa trên ngôn ngữ cử chỉ, trực giác hay võ đoán.\r\n\r\nCuốn sách được chia làm hai phần và 15 chương:\r\n\r\nPhần 1: Bảy câu hỏi cơ bản: Học cách phát hiện ra điều người khác nghĩ hay cảm nhận một cách dễ dàng và nhanh chóng trong bất kỳ hoàn cảnh nào.\r\n\r\nPhần 2: Những kế hoạch chi tiết cho hoạt động trí óc - hiểu được quá trình ra quyết định. Vượt ra ngoài việc đọc các suy nghĩ và cảm giác đơn thuần: Hãy học cách người khác suy nghĩ để có thể nắm bắt bất kỳ ai, phán đoán hành xử và hiểu được họ còn hơn chính bản thân họ.\r\n\r\nTrích đoạn sách hay:\r\n\r\nMột giám đốc phụ trách bán hàng nghi ngờ một trong những nhân viên kinh doanh của mình đang biển thủ công quỹ. Nếu hỏi trực tiếp “Có phải cô đang lấy trộm đồ của công ty?” sẽ khiến người bị nghi ngờ phòng bị ngay lập tức, việc muốn tìm ra chân tướng sự việc càng trở nên khó khăn hơn. Nếu cô ta không làm việc đó, dĩ nhiên cô ta sẽ nói với người giám đốc mình không lấy trộm. Ngược lại, dù có lấy trộm đi chăng nữa, cô ta cũng sẽ nói dối mình không hề làm vậy. Thay vào việc hỏi trực diện, người giám đốc khôn ngoan nên nói một điều gì đó tưởng chừng vô hại, như “Jill, không biết cô có giúp được tôi việc này không. Có vẻ như dạo này có người trong phòng đang lấy đồ của công ty về nhà phục vụ cho tư lợi cá nhân. Cô có hướng giải quyết nào cho việc này không?” rồi bình tĩnh quan sát phản ứng của người nhân viên.\r\n\r\nNếu cô ta hỏi lại và có vẻ hứng thú với đề tài này, anh ta có thể tạm an tâm rằng cô ta không lấy trộm, còn nếu cô ta đột nhiên trở nên không thoải mái và tìm cách thay đổi đề tài thì rõ ràng cô ta có động cơ không trong sáng.\r\n\r\nNgười giám đốc khi đó sẽ nhận ra sự chuyển hướng đột ngột trong thái độ và hành vi của người nhân viên. Nếu cô gái đó hoàn toàn trong sạch, có lẽ cô ta sẽ đưa ra hướng giải quyết của mình và vui vẻ khi sếp hỏi ý kiến của mình. Ngược lại, cô ta sẽ có biểu hiện không thoải mái rõ ràng và có lẽ sẽ cố cam đoan với sếp rằng cô không đời nào làm việc như vậy. Không có lí do gì để cô ta phải thanh minh như vậy, trừ phi cô là người có cảm giác tội lỗi…', 'Nguyễn Thị Vân Anh', 3, 223, 2022, 'Con', 'A23', NULL, 'img_book/9786043445589.jpg'),
('9786044777486', 'ấdsad', 'dấds', 'sadgsaj', 3, 123123, 1233, 'Con', 'B21', 3, 'img_book/9786044777486.jpg'),
('9786044818795', 'AI 5.0 - Nhanh hơn, dễ hơn, rẻ hơn, chính xác hơn', 'AI 5.0 - Nhanh Hơn, Dễ Hơn, Rẻ Hơn, Chính Xác Hơn\r\n\r\nTrí tuệ nhân tạo (AI) đã tác động đến nhiều ngành công nghiệp trên toàn thế giới như: tài chính ngân hàng, dược phẩm, ô tô, công nghệ y tế, sản xuất và bán lẻ. Nhưng nó chỉ mới bắt đầu cuộc phiêu lưu hướng tới những dự đoán rẻ hơn, tốt hơn và nhanh hơn nhằm thúc đẩy các quyết định kinh doanh chiến lược.\r\n\r\nTrong cuốn sách AI 5.0 – Nhanh hơn, dễ hơn, rẻ hơn, chính xác hơn, các tác giả đi sâu vào việc xem xét đơn vị phân tích cơ bản nhất: Quyết định. Các tác giả giải thích rằng hai thành phần quan trọng trong việc đưa ra quyết định là: Dự đoán và Phán đoán, và chúng ta thực hiện cả hai yếu tố đó cùng nhau trong tâm trí mà thường không nhận ra.\r\n\r\nSự phát triển của AI đang chuyển dự đoán từ con người sang máy móc, giúp con người giảm bớt gánh nặng nhận thức này đồng thời tăng tốc độ và độ chính xác của các quyết định. Điều này có ý nghĩa sâu sắc đối với sự đổi mới ở cấp độ hệ thống.\r\n\r\nViệc thiết kế lại các hệ thống đưa ra các quyết định phụ thuộc lẫn nhau cần có thời gian, nhiều ngành đang trong tình trạng yên tĩnh trước cơn bão, nhưng khi những hệ thống mới này xuất hiện, chúng có thể gây rối loạn trên quy mô toàn cầu.\r\n\r\nChứa đầy những hiểu biết sâu sắc, ví dụ phong phú và lời khuyên thực tế, AI 5.0 – Nhanh hơn, dễ hơn, rẻ hơn, chính xác hơn à hướng dẫn phải đọc cho bất kỳ nhà lãnh đạo doanh nghiệp hoặc nhà hoạch định chính sách nào về cách khiến những gián đoạn AI sắp tới có lợi cho bạn thay vì cản trở bạn. Đồng thời, các tác giả chỉ ra cách doanh nghiệp có thể tận dụng cơ hội cũng như bảo vệ vị thế của mình.\r\n\r\nVề tác giả:\r\n\r\nAJAY AGRAWAL là giáo sư về quản lý chiến lược và là Chủ tịch Geoffrey Taber về Khởi nghiệp và Đổi mới tại Trường Quản lý Rotman của Đại học Toronto. Ông là một thành viên ban cố vấn tại Trung tâm Công nghệ và Xã hội Khối Đại học Carnegie Mellon, ở Pittsburgh; và một khoa liên kết tại Viện Trí tuệ nhân tạo Vector, ở Toronto. Ông cũng là người đồng sáng lập công ty AI/robot Sanctuary.\r\n\r\nJOSHUA GANS là giáo sư về quản lý chiến lược và là người giữ chức Chủ tịch Jeffrey S. Skoll về Đổi mới Kỹ thuật và Tinh thần Doanh nhân tại Trường Quản lý Rotman, Đại học Toronto. Ông là cộng tác viên nghiên cứu tại Cục Nghiên cứu Kinh tế Quốc gia và có học bổng tại MIT, Viện e61, Học viện Luohan, Trung tâm Phân tích Kinh tế Quốc tế, Trường Kinh doanh Melbourne.\r\n\r\nAVI GOLDFARB là Chủ tịch Rotman về Trí tuệ nhân tạo và Chăm sóc sức khỏe, đồng thời là giáo sư tiếp thị tại Trường Quản lý Rotman, Đại học Toronto. Ông đã xuất bản các bài báo học thuật về tiếp thị, máy tính, luật, quản lý, y học, vật lý, khoa học chính trị, y tế công cộng, thống kê và kinh tế. Công trình của ông về quảng cáo trực tuyến đã giành được Giải thưởng Tác động Dài hạn của Hiệp hội Khoa học Tiếp thị INFORMS.', 'Lê Dung', 3, 432, 2024, 'Con', 'A31', NULL, 'img_book/9786044818795.jpg'),
('9786045844502', 'Cách nghĩ để thành công', 'Cuốn sách \"Cách Nghĩ Để Thành Công\" (tựa gốc: Think and Grow Rich) của Napoleon Hill là một tác phẩm kinh điển về phát triển bản thân và làm giàu, được xuất bản lần đầu vào năm 1937. Sau hơn 20 năm nghiên cứu và phỏng vấn hơn 500 người thành công nhất thời bấy giờ (bao gồm Andrew Carnegie, Henry Ford, Thomas Edison, F.W. Woolworth, và Alexander Graham Bell), Napoleon Hill đã đúc kết được 13 nguyên tắc mà ông cho là bí quyết chung dẫn đến sự giàu có và thành công vượt bậc. Sách không chỉ nói về tiền bạc mà còn là một triết lý toàn diện về cách làm chủ tư duy để kiến tạo mọi điều bạn mong muốn trong cuộc sống.\r\n\r\nTriết Lý Cốt Lõi: Sức Mạnh Của Tư Duy Và Niềm Tin\r\nNapoleon Hill khẳng định rằng, sự giàu có và thành công bắt đầu từ tư duy. \"Những gì tâm trí con người có thể hình dung và tin tưởng, nó đều có thể đạt được.\" Đây là nguyên lý nền tảng xuyên suốt toàn bộ tác phẩm. Tiền bạc không chỉ là vật chất mà là kết quả của một trạng thái tinh thần, một thái độ sống và một hệ thống tư duy.\r\n\r\nHill nhấn mạnh tầm quan trọng của:\r\n\r\nNiềm khao khát cháy bỏng (Burning Desire): Đây là điểm khởi đầu của mọi thành tựu. Bạn phải có một khao khát mãnh liệt, cụ thể và không ngừng nghỉ về điều bạn muốn đạt được, không chỉ là một ước muốn hời hợt.\r\nNiềm tin (Faith): Tin tưởng tuyệt đối vào khả năng của bản thân và vào việc bạn sẽ đạt được mục tiêu, ngay cả khi chưa có bằng chứng cụ thể. Niềm tin là \"hóa chất\" duy nhất giúp tiềm thức giải phóng năng lượng vô hạn.\r\nTự kỷ ám thị (Autosuggestion): Là phương tiện để giao tiếp với tiềm thức. Bằng cách lặp đi lặp lại những lời khẳng định tích cực về mục tiêu của mình một cách có cảm xúc và niềm tin, bạn có thể biến niềm khao khát thành niềm tin và thúc đẩy tiềm thức hành động.\r\n13 Nguyên Tắc Vàng Để Nghĩ Giàu, Làm Giàu\r\nNapoleon Hill trình bày 13 nguyên tắc một cách hệ thống, tạo thành một lộ trình thực hành, từ việc định hình mục tiêu cho đến việc duy trì sức mạnh tinh thần:\r\n\r\nKhao Khát: Biến mong muốn về tiền bạc thành một khao khát cháy bỏng. Cần viết ra số tiền cụ thể, thời hạn, cách thức đạt được, và đọc to nó mỗi ngày.\r\nNiềm Tin: Phát triển và nuôi dưỡng niềm tin vào khả năng của bạn để đạt được mục tiêu. Niềm tin là sức mạnh vô hạn của tiềm thức.\r\nTự Kỷ Ám Thị: Sử dụng các câu khẳng định tích cực, lặp đi lặp lại có chủ đích để lập trình tiềm thức, biến suy nghĩ thành niềm tin.\r\nKiến Thức Chuyên Biệt: Học hỏi và tích lũy kiến thức cụ thể, chuyên sâu trong lĩnh vực bạn muốn thành công. Quan trọng là biết cách áp dụng kiến thức đó vào thực tế.\r\nTrí Tưởng Tượng: Khả năng biến những ý tưởng thành hiện thực thông qua việc hình dung. Trí tưởng tượng là nơi mọi kế hoạch ra đời và được định hình.\r\nLập Kế Hoạch Có Tổ Chức: Biến khao khát thành hành động cụ thể thông qua các kế hoạch chi tiết, khả thi. Thất bại trong việc lập kế hoạch là kế hoạch cho sự thất bại.\r\nQuyết Định: Sự dứt khoát trong việc đưa ra quyết định. Người thành công là người nhanh chóng đưa ra quyết định và ít thay đổi quyết định một khi đã đưa ra.\r\nKiên Trì: Bền bỉ theo đuổi mục tiêu, không bỏ cuộc dù gặp khó khăn, thất bại hay sự phản đối. Đây là yếu tố quyết định sự thành công vượt trội.\r\nSức Mạnh Của Khối Óc Bậc Thầy (Mastermind Alliance): Hợp tác với một nhóm người có cùng chí hướng, cùng mục tiêu để tạo ra sức mạnh tổng hợp về trí tuệ, kinh nghiệm và tinh thần. Sức mạnh tổng hợp này lớn hơn tổng các phần cộng lại.\r\nSức Mạnh Của Năng Lượng Tình Dục (Sex Transmutation): Chuyển hóa năng lượng của ham muốn tình dục (một trong những động lực mạnh mẽ nhất của con người) thành năng lượng sáng tạo, động lực để đạt được mục tiêu cao hơn.\r\nTiềm Thức: Hiểu và biết cách lập trình tiềm thức để nó hoạt động vì lợi ích của bạn, biến những ý niệm được gieo vào thành hiện thực.\r\nBộ Não: Hiểu cách não bộ hoạt động như một trạm phát và thu sóng tư duy, và cách bạn có thể sử dụng nó để kết nối với trí tuệ vô hạn.\r\nGiác Quan Thứ Sáu: Phát triển khả năng trực giác, nhận thức những điều vượt ra ngoài năm giác quan thông thường, giúp đưa ra quyết định sáng suốt và nhận biết các cơ hội.', 'Nguyễn Thị Hồng Vân', 2, 400, 2012, 'Con', 'A13', 2, 'img_book/9786045844502.jpg'),
('9786045855034', 'Cuộc sống không giới hạn', 'Cuộc sống là do mỗi người đặt ra cho mình, giới hạn ấy thể hiện rõ khả năng và sự nỗ lực của bạn trong việc ước mơ và chinh phục ước mơ. Giới hạn ấy, tất nhiên, là hoàn cảnh sống, là tính cách, là con người, là khả năng tài chính, là điều kiện giáo dục,... Và đôi khi, chúng ta đổ lỗi cho chúng vì sự thất bại của mình.\r\n\r\nNhưng vốn dĩ cuộc sống thực sự không có giới hạn nào cả, chỉ cần bạn có đủ sức mạnh, ý chí và khả năng để chinh phục thì giới hạn cuộc sống vĩnh viễn nằm ở điểm vô cực.\r\n\r\n“Bạn đẹp đẽ và quý giá hơn tất cả những viên kim cương trên thế gian này. Dẫu vậy, chúng ta nên luôn luôn đặt ra cho mình mục tiêu trở thành những con người tốt hơn, toàn thiện hơn, đẩy lùi và loại bỏ những giới hạn bằng cách mơ những giấc mơ lớn lao. Trong hành trình đó, chúng ta luôn cần có những điều chỉnh (bởi vì cuộc đời này không phải lúc nào cũng toàn là màu hồng), nhưng cuộc đời này luôn đáng sống. Tôi đến đây để nói với bạn rằng cho dù bạn đang ở trong hoàn cảnh nào, miễn là bạn còn thở, thì bạn vẫn có thể đóng góp cho cuộc đời này…”\r\n\r\nCuộc Sống Không Giới Hạn không chỉ là một cuộc đời, cũng không chỉ rao giảng những bài học trống rỗng và vô hồn về sức mạnh của con người. Câu chuyện của Nick là câu chuyện đã làm rung động trái tim hàng triệu người về nghị lực sống, khát vọng chinh phục, sức mạnh vượt qua những khó khăn bất tận của cuộc sống để làm chủ cuộc đời mình.\r\n\r\nCuộc Sống Không Giới Hạn - Nick Vujicic\r\nCâu Chuyện Diệu Kỳ Của Chàng Trai Đặc Biệt Nhất Hành Tinh\r\n\r\nNick sinh ra mắc hội chứng Tetra-amelia bẩm sinh, một rối loạn gene hiếm gặp gây ra sự thiếu hụt chân, tay. Điều đó đồng nghĩa với việc anh có rất ít hy vọng để sống một cuộc đời bình thường. Người mẹ và người cha thân yêu của anh lần đầu nhìn thấy con trai đã sốc kinh khủng. Sự ra đời của Nick đã làm chao đảo cả cuộc sống của một gia đình trẻ. Họ khó có thể chấp nhận được sự thật đau lòng về đứa con bé bỏng; không chỉ vô cùng đau khổ, họ còn hết sức lo lắng cho tương lai của con trai.\r\n\r\nLớn lên, bắt đầu ý thức về thân phận của mình cũng là lúc Nick chỉ muốn biến mất khỏi cuộc sống. Như anh từng tâm sự: “Hoàn cảnh nghiệt ngã tưởng đã có lúc nhấn chìm tôi. Hơn ai hết, tôi từng muốn tự tử, và đã từng rất nhiều lần định bỏ cuộc. Nhưng cuối cùng, tôi đã can đảm đứng dậy sau hàng ngàn lần ngã…”\r\nĐiều gì đã khiến Nick đứng dậy và đi qua tất cả? Đó thật sự là một điều kỳ diệu lớn lao – Khát vọng sống mãnh liệt và ý chí quật cường chiến thắng số phận.\r\n\r\n“Thường thì chúng ta cứ tự nhủ rằng mình không đủ thông minh hoặc không đủ hấp dẫn hoặc không đủ tài năng để theo đuổi những ước mơ. Chúng ta tin những gì người khác nói về chúng ta,hoặc tự đặt ra những giới hạn cho bản thân mình. Tồi tệ hơn, khi bạn tự coi mình là một người vô giá trị có nghĩa là bạn đang đặt ra giới hạn cho những điều kỳ diệu mà Chúa có thể trao gửi cho bạn!”-(Nick Vujicic)\r\n\r\n“Từ sâu thẳm trái tim mình, tôi tin rằng cuộc đời không có bất cứ giới hạn nào hết. Cho dù những thách thức mà bạn đang phải đối mặt là gì đi nữa, cho dù những thách thức ấy có khốc liệt, nghiệt ngã đến mức nào chăng nữa, tôi cũng mong bạn hãy tin tưởng và cảm thấy như vậy về cuộc sống của chính mình…” - (Nick Vujicic)\r\n\r\nNick đã và đang sống để chứng minh chân lý lớn lao: Không có giới hạn nào lớn hơn sự tự giới hạn chính mình. Chỉ cần nhắc tới cái tên Nick Vujicic, hàng triệu người trên toàn cầu đã có thể bật khóc vì xúc động và cảm phục. Nick đã trở thành một ân phúc thật sự cho những ai được tiếp xúc với anh, hoặc từng biết đến anh qua sách, báo, băng đĩa, internet…\r\n\r\nKhông có tay, Nick Vujicic vẫn chạm tới trái tim của hàng triệu người mỗi khi hiện diện. Không có chân, Nick vẫn đi tới khắp mọi nơi trên toàn thế giới. Hiện tại, Nick là Chủ tịch và là CEO của tổ chức quốc tế Life Without Limbs, là giám đốc công ty Attitude Is Altitude, đồng thời là một diễn giả có sức truyền cảm lớn nhất và đặc biệt nhất hành tinh.\r\n\r\n“Là đứa con của Chúa, bạn chắc chắn đẹp đẽ và quý giá hơn tất cả những viên kim cương trên thế gian này. Bạn và tôi cực kỳ thích hợp để trở thành những con người mà đấng sáng tạo ra chúng ta muốn chúng ta trở thành! Dẫu vậy, chúng ta nên luôn luôn đặt ra cho mình mục tiêu trở thành những con người tốt hơn, toàn thiện hơn, đẩy lùi và loại bỏ những giới hạn bằng cách mơ những giấc mơ lớn lao. Trong hành trình đó, chúng ta luôn cần có những điều chỉnh (bởi vì cuộc đời này không phải lúc nào cũng toàn là màu hồng), nhưng cuộc đời này luôn đáng sống. Tôi đến đây để nói với bạn rằng cho dù bạn đang ở trong hoàn cảnh nào, miễn là bạn còn thở, thì bạn vẫn có thể đóng góp cho cuộc đời này…”\r\n\r\n\r\n“Tôi không thể đặt bàn tay lên vai bạn để động viên, nhưng tôi có thể nói lời nói chân thành nhất từ tận đáy lòng mình. Dù cuộc đời của bạn có đáng thất vọng đến mức nào, thì niềm hy vọng vẫn luôn ở phía trước. Trong khốn cùng, vẫn có ngày mai tươi sáng đang chờ bạn…” – (Nick Vujicic)\r\n\r\nCuộc Sống Không Giới Hạn không chỉ đơn giản kể lại câu chuyện của cậu bé Nick không tay, không chân vượt qua khó khăn trong cuộc sống như thế nào, để có được cuộc sống tràn ngập tiếng cười ngày hôm nay, Nick đã có những ngày tháng đầy nước mắt như thế nào. Vượt lên trên hết là nghị lực phi thường, sự mạnh mẽ không biên giới, ý chí vượt thoát khỏi hoàn cảnh nghiệt ngã của số phận.\r\n\r\nChuyện cổ tích hiện hữu trong đời thực\r\n\r\nNick hiện tại đang vô cùng hạnh phúc bên người vợ tên là Kanae Miyahara, một cô gái xinh đẹp,hoàn toàn bình thường. Đám cưới của họ diễn ra vào ngày 10 tháng 2 năm 2012 ở California, Mỹ. Hàng trăm tờ báo trên thế giới đã đưa tin về đám cưới của Nick. Người ta gọi đám cưới của Nick là đám cưới của thế kỷ, là sự kiện tuyệt vời nhất, thông điệp hy vọng có sức thuyết phục nhất của năm2012.\r\n\r\nVà hơn thế, Nick đang hồi hộp chờ đón đứa con đầu lòng. Đó là đứa bé được sinh ra từ lòng can trường của người bố và tình yêu tuyệt vời của người mẹ. Nhưng đó không phải là điều kỳ diệu duy nhất của cuộc sống và của Nick, chính chúng ta cũng hoàn toàn có thể biến cuộc sống của chính chúng ta trở thành kỳ diệu khi biết thoát ra những điều giới hạn, biết đối mặt với thử thách, và hơn hết đừng bao giờ hoài nghi về khả năng của bản thân mình, như Nick mong muốn thông qua cuốn tự truyện “Cuộc Sống Không Giới Hạn”.', 'Nguyễn Ngọc Ánh', 3, 408, 2020, 'Con', 'A32', 4, 'img_book/9786045855034.jpg'),
('9786045885239', 'Hạt Giống Tâm Hồn - Tập 2: Cho Lòng Dũng Cảm Và Tình Yêu Cuộc Sống', 'Hạt Giống Tâm Hồn - Tập 2: Cho Lòng dũng Cảm Và Tình Yêu Cuộc Sống\r\n\r\n“Cuộc sống vốn có nhiều khó khăn thử thách và cả thất vọng, nỗi buồn. Dũng cảm vượt qua để luôn là chính mình và đừng để điều gì có thể che khuất ước mơ, niềm tin và hoài bão”.\r\n\r\nĐó chính là ý tưởng chính của hai tập sách Hạt giống tâm hồn: Cho Lòng Dũng Cảm và Tình Yêu Cuộc Sống do First News (NXB TP. HCM) phát hành. Tập sách gồm 100 bài viết, truyện ngắn hay, có ý nghĩa sâu sắc (mỗi tập 50 truyện), gần gũi với cuộc sống, mang tính tự nhận thức và giáo dục cao.\r\n\r\nTrong cuộc sống chúng ta ai cũng có một ước mơ cho một ngày mai thật đẹp, dù bình dị hay phi thường. Đó có thể là ước mơ của một cậu bé mồ côi mong có ngày được chăm sóc trong vòng tay người mẹ; ước mơ của một chú bé tật nguyền được bước đi bình thường như bao người khác; ước mơ nhìn thấy ánh sáng của một người mù; ước mơ tìm được việc làm của một chàng trai thất nghiệp…; hoặc có thể là những ước mơ chinh phục, vượt qua thử thách, vươn lên khẳng định mình và trở thành những gì mà mình từng ao ước…           \r\n\r\nNhưng cuộc sống luôn tiềm ẩn những trở ngại, khó khăn và thử thách bất ngờ - con đường đi đến những ước mơ ấy không hề bằng phẳng. Bao khó khăn, trở ngại và cả bất hạnh có thể xảy ra vào những lúc không mong chờ nhất như để thử thách lòng dũng cảm của con người.\r\n\r\nTrước những khó khăn thử thách ấy, mỗi người sẽ tự chọn cho mình cách đón nhận, đối đầu để có một hướng đi riêng. Có người phó thác cho số phận, có người trốn chạy đi tìm nơi trú ẩn, có người tự thay đổi để thích nghi với hoàn cảnh mới, cũng có người chìm vào biển tự than thân, trách phận để rồi ngã gục trong cơn dông tố cuộc đời...\r\n\r\nThế nhưng, bất kể là ai, tự đáy lòng của mỗi con người đều tồn tại một khát vọng mãnh liệt - đó là khát vọng sống và được luôn là chính mình. Chính khát vọng ấy đã khiến bao trái tim trăn trở, thao thức tìm cho mình một cách nghĩ, một sức mạnh tinh thần, một hướng đi để theo đuổi những hoài bão, ước mơ của mình.\r\n\r\nBáo chí nói gì về cuốn sách này:\r\n\r\n“Bạn đọc có thể bắt gặp câu chuyện của chính mình, của những người xung quanh hay những người hoàn toàn xa lạ… để rồi suy ngẫm, chiêm nghiệm, khám phá và tìm thấy điều ý nghĩa nhất cũng như tìm thấy câu châm ngôn cho cuộc sống của mình.” –Tuổi Trẻ\r\n\r\n“Đọc Hạt giống tâm hồn, chúng ta sẽ thấy được những cánh cửa mở ra cho mình khi ở bước đường cùng.” – Người Lao Động\r\n\r\n“Hạt giống tâm hồn trở thành một hiện tượng văn hóa cộng đồng, biểu tượng nhân văn lan tỏa đến mọi ngóc ngách của người dân Việt Nam qua những nội dung sâu sắc, thực tế.” – Giáo Dục\r\n\r\n“Hạt giống tâm hồn là những câu chuyện giản dị nhưng giàu ý nghĩa nhân văn, giàu cảm xúc giáo dục để bồi dưỡng tâm hồn.” - Sài Gòn Giải Phóng\r\n\r\n“Hạt Giống Tâm Hồn cái tựa nghe thôi cũng rất trìu mến, thân thương và gần gũi đến thế. Trước khi thành công thì nên thành nhân trước là vậy. Bên trong con người ai cũng có những hạt giống đầy tốt đẹp và cần được nuôi dưỡng, vun đắp. Một tâm hồn khai mở và rộng lớn thì chắc chắn sẽ làm được điều gì đó giúp ích cho xã hội.” – Một Thế Giới', 'Phan Huyền Thư', 3, 162, 2023, 'Con', 'A21', 3, 'img_book/9786045885239.jpg'),
('9786046948506', 'Nhà giả kim', 'Tất cả những trải nghiệm trong chuyến phiêu du theo đuổi vận mệnh của mình đã giúp Santiago thấu hiểu được ý nghĩa sâu xa nhất của hạnh phúc, hòa hợp với vũ trụ và con người.\r\n\r\nTiểu thuyết Nhà giả kim của Paulo Coelho như một câu chuyện cổ tích giản dị, nhân ái, giàu chất thơ, thấm đẫm những minh triết huyền bí của phương Đông. Trong lần xuất bản đầu tiên tại Brazil vào năm 1988, sách chỉ bán được 900 bản. Nhưng, với số phận đặc biệt của cuốn sách dành cho toàn nhân loại, vượt ra ngoài biên giới quốc gia, Nhà giả kim đã làm rung động hàng triệu tâm hồn, trở thành một trong những cuốn sách bán chạy nhất mọi thời đại, và có thể làm thay đổi cuộc đời người đọc.\r\n\r\n“Nhưng nhà luyện kim đan không quan tâm mấy đến những điều ấy. Ông đã từng thấy nhiều người đến rồi đi, trong khi ốc đảo và sa mạc vẫn là ốc đảo và sa mạc. Ông đã thấy vua chúa và kẻ ăn xin đi qua biển cát này, cái biển cát thường xuyên thay hình đổi dạng vì gió thổi nhưng vẫn mãi mãi là biển cát mà ông đã biết từ thuở nhỏ. Tuy vậy, tự đáy lòng mình, ông không thể không cảm thấy vui trước hạnh phúc của mỗi người lữ khách, sau bao ngày chỉ có cát vàng với trời xanh nay được thấy chà là xanh tươi hiện ra trước mắt. ‘Có thể Thượng đế tạo ra sa mạc chỉ để cho con người biết quý trọng cây chà là,’ ông nghĩ.”', 'Lê Chu Cầu', 2, 227, 2020, 'Con', 'A12', 1, 'img_book/9786046948506.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach_tacgia`
--

CREATE TABLE `sach_tacgia` (
  `ISBN13` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `MaTG` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sach_tacgia`
--

INSERT INTO `sach_tacgia` (`ISBN13`, `MaTG`) VALUES
('9786043043303', 'TG_1'),
('9786043177771', 'TG_1'),
('9786043351668', 'TG_1'),
('9786043177770', 'TG_10'),
('9786044777486', 'TG_10'),
('9786043177771', 'TG_11'),
('9786044777486', 'TG_11'),
('9786044818795', 'TG_11'),
('9786043177771', 'TG_12'),
('9786044818795', 'TG_12'),
('9786043177771', 'TG_13'),
('9786044818795', 'TG_13'),
('9786043147735', 'TG_14'),
('9786043147735', 'TG_15'),
('9786046948506', 'TG_2'),
('9786045844502', 'TG_3'),
('9786045885239', 'TG_4'),
('9786043445589', 'TG_6'),
('9786045855034', 'TG_8');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sach_theloai`
--

CREATE TABLE `sach_theloai` (
  `ISBN13` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TheLoaiID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sach_theloai`
--

INSERT INTO `sach_theloai` (`ISBN13`, `TheLoaiID`) VALUES
('9786043043303', 1),
('9786043177770', 1),
('9786043351668', 1),
('9786043445589', 1),
('9786045844502', 1),
('9786045855034', 1),
('9786043043303', 2),
('9786043351668', 2),
('9786045844502', 2),
('9786043177770', 3),
('9786043177770', 4),
('9786046948506', 5),
('9786046948506', 6),
('9786043043303', 7),
('9786043445589', 7),
('9786045855034', 7),
('9786045885239', 7),
('9786046948506', 7),
('9786045885239', 8),
('9786045855034', 9),
('9786045885239', 9),
('9786043177771', 10),
('9786043445589', 10),
('9786043147735', 11),
('9786044818795', 11),
('9786043147735', 12),
('9786044818795', 12),
('9786043147735', 13),
('9786044818795', 13),
('9786045844502', 13),
('9786043177771', 19),
('9786043177771', 28),
('9786044777486', 30),
('9786044777486', 31),
('9786044777486', 32);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('XLguSm6VDKHvDw6Xl9dc56Y0VNgPH4dpCs7Snc8G', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMXBjc2lLamg4OUd6ZTNMUkxQc3JmUENJdGd3czZ3RU1EMGkweVU5RSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zYWNoIjtzOjU6InJvdXRlIjtzOjEwOiJzYWNoLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NjYxMDMwMzc7fX0=', 1766109867),
('iF67Ark2bKsLWiMyvo68ybRYtLNuWfMLStZaOvQD', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTjVsd3MwQ3Y4SVpHQ1puYm1JOU5POUdoemxhaGl0b3IyYkR3V1kxSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90YWNnaWEiO3M6NToicm91dGUiO3M6MTI6InRhY2dpYS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1766194808);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tacgia`
--

CREATE TABLE `tacgia` (
  `MaTG` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenTG` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tacgia`
--

INSERT INTO `tacgia` (`MaTG`, `TenTG`) VALUES
('TG_1', 'Dale Carnegie'),
('TG_10', 'George S. Clason'),
('TG_11', 'Ajay Agrawal'),
('TG_12', 'Joshua Gans'),
('TG_13', 'Avi Goldfarb'),
('TG_14', 'Ravin Jesuthasan'),
('TG_15', 'John W. Boudreau'),
('TG_16', 'alex'),
('TG_17', 'sdasd'),
('TG_2', 'Paulo Coelho'),
('TG_3', 'Napoleon Hill'),
('TG_4', 'Jack Canfield'),
('TG_6', 'David J. Lieberman'),
('TG_8', 'Nick Vujicic'),
('TG_9', 'Mark Victor Hansen');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thedocgia`
--

CREATE TABLE `thedocgia` (
  `MaDocGia` varchar(37) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `TenDocGia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Khoa` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Lop` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TrangThai` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `thedocgia`
--

INSERT INTO `thedocgia` (`MaDocGia`, `TenDocGia`, `Khoa`, `Lop`, `TrangThai`) VALUES
('DH52111178_NGUYENLEANHKIET_03.08.2003', 'Nguyễn Văn A', 'Công nghệ thông tin', 'D21_TH01', 'HoatDong'),
('DH52134567', 'Trần Thị B', 'Công nghệ thông tin', 'D21_TH02', 'HoatDong'),
('DH52167890', 'Hoàng Văn E', 'Công nghệ thông tin', 'D21_TH05', 'HoatDong');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `theloai`
--

CREATE TABLE `theloai` (
  `id` int NOT NULL,
  `TenTheLoai` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `theloai`
--

INSERT INTO `theloai` (`id`, `TenTheLoai`) VALUES
(1, 'Self-help'),
(2, 'Phát triển bản thân'),
(3, 'Tài chính'),
(4, 'Quản lý tiền'),
(5, 'Tiểu thuyết'),
(6, 'Triết lý'),
(7, 'Tâm lý'),
(8, 'Văn học cảm hứng'),
(9, 'Câu chuyện ý nghĩa'),
(10, 'Kỹ năng giao tiếp'),
(11, 'Công nghệ'),
(12, 'AI'),
(13, 'Kinh doanh'),
(14, 'Văn học Việt Nam'),
(15, 'Văn học nước ngoài'),
(16, 'Truyện ngắn'),
(17, 'Thơ'),
(18, 'Truyện tranh'),
(19, 'Manga'),
(20, 'Nghệ thuật'),
(21, 'Giáo trình'),
(22, 'Sách tham khảo'),
(23, 'Khoa học'),
(24, 'Toán học'),
(25, 'Vật lý'),
(26, 'Hóa học'),
(27, 'Sinh học'),
(28, 'Ngôn ngữ học'),
(29, 'Từ điển'),
(30, 'Lập trình'),
(31, 'Khoa học máy tính'),
(32, 'Mạng máy tính'),
(33, 'An toàn thông tin'),
(34, 'Phần mềm'),
(35, 'Lịch sử'),
(36, 'Địa lý'),
(37, 'Chính trị'),
(38, 'Xã hội học'),
(39, 'Văn hóa'),
(40, 'Thiếu nhi'),
(41, 'Gia đình'),
(42, 'Nấu ăn'),
(43, 'Du lịch'),
(44, 'Thể thao'),
(45, 'Sức khỏe'),
(46, 'Y học'),
(47, 'Tôn giáo'),
(48, 'Tâm linh'),
(49, 'Thiền'),
(50, 'Phật giáo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Lê Anh Kiệt', 'kieta123123@gmail.com', NULL, '$2y$12$0u55lB7XD00vVkyfrbVENOAY/5aaLo47w73OY6kaOvPRJBcOZAuNO', 'vDYjWlxiYppXcYIpdrV40R6tcozRYfRQJ5cLwm6JmUwBI2QfjOKsUdcJ7vd2', '2025-11-19 03:51:22', '2025-11-19 03:51:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vitri`
--

CREATE TABLE `vitri` (
  `MaVT` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Khu` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Day` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Ke` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `vitri`
--

INSERT INTO `vitri` (`MaVT`, `Khu`, `Day`, `Ke`) VALUES
('A11', 'Khu A', 'Dãy 1', 'Kệ 1'),
('A12', 'Khu A', 'Dãy 1', 'Kệ 2'),
('A13', 'Khu A', 'Dãy 1', 'Kệ 3'),
('A21', 'Khu A', 'Dãy 2', 'Kệ 1'),
('A22', 'Khu A', 'Dãy 2', 'Kệ 2'),
('A23', 'Khu A', 'Dãy 2', 'Kệ 3'),
('A31', 'Khu A', 'Dãy 3', 'Kệ 1'),
('A32', 'Khu A', 'Dãy 3', 'Kệ 2'),
('A33', 'Khu A', 'Dãy 3', 'Kệ 3'),
('B11', 'Khu B', 'Dãy 1', 'Kệ 1'),
('B12', 'Khu B', 'Dãy 1', 'Kệ 2'),
('B13', 'Khu B', 'Dãy 1', 'Kệ 3'),
('B21', 'Khu B', 'Dãy 2', 'Kệ 1'),
('B22', 'Khu B', 'Dãy 2', 'Kệ 2'),
('B23', 'Khu B', 'Dãy 2', 'Kệ 3'),
('B31', 'Khu B', 'Dãy 3', 'Kệ 1'),
('B32', 'Khu B', 'Dãy 3', 'Kệ 2'),
('B33', 'Khu B', 'Dãy 3', 'Kệ 3');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `muontra`
--
ALTER TABLE `muontra`
  ADD PRIMARY KEY (`MaMuon`),
  ADD KEY `muontra_ibfk_2` (`MaDocGia`),
  ADD KEY `fk_muontra_users` (`user_id`);

--
-- Chỉ mục cho bảng `muontra_chitiet`
--
ALTER TABLE `muontra_chitiet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_mamuon_isbn` (`MaMuon`,`ISBN13`),
  ADD KEY `idx_isbn_trangthai` (`ISBN13`);

--
-- Chỉ mục cho bảng `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `nhaxuatban` ADD FULLTEXT KEY `TenNXB` (`TenNXB`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`ISBN13`),
  ADD KEY `MaVT` (`MaVT`),
  ADD KEY `fk_sach_nhaxuatban` (`MaNXB`);
ALTER TABLE `sach` ADD FULLTEXT KEY `ft_sach_ten_dich` (`TenSach`,`NguoiDich`);
ALTER TABLE `sach` ADD FULLTEXT KEY `TenSach` (`TenSach`,`NguoiDich`);

--
-- Chỉ mục cho bảng `sach_tacgia`
--
ALTER TABLE `sach_tacgia`
  ADD PRIMARY KEY (`ISBN13`,`MaTG`),
  ADD KEY `MaTG` (`MaTG`);

--
-- Chỉ mục cho bảng `sach_theloai`
--
ALTER TABLE `sach_theloai`
  ADD PRIMARY KEY (`ISBN13`,`TheLoaiID`),
  ADD KEY `TheLoaiID` (`TheLoaiID`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`MaTG`);
ALTER TABLE `tacgia` ADD FULLTEXT KEY `TenTG` (`TenTG`);

--
-- Chỉ mục cho bảng `thedocgia`
--
ALTER TABLE `thedocgia`
  ADD PRIMARY KEY (`MaDocGia`);

--
-- Chỉ mục cho bảng `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `vitri`
--
ALTER TABLE `vitri`
  ADD PRIMARY KEY (`MaVT`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `muontra`
--
ALTER TABLE `muontra`
  MODIFY `MaMuon` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `muontra_chitiet`
--
ALTER TABLE `muontra_chitiet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `theloai`
--
ALTER TABLE `theloai`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ràng buộc đối với các bảng kết xuất
--

--
-- Ràng buộc cho bảng `muontra`
--
ALTER TABLE `muontra`
  ADD CONSTRAINT `fk_muontra_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `muontra_ibfk_2` FOREIGN KEY (`MaDocGia`) REFERENCES `thedocgia` (`MaDocGia`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `muontra_chitiet`
--
ALTER TABLE `muontra_chitiet`
  ADD CONSTRAINT `fk_ct_muontra` FOREIGN KEY (`MaMuon`) REFERENCES `muontra` (`MaMuon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ct_sach` FOREIGN KEY (`ISBN13`) REFERENCES `sach` (`ISBN13`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `fk_sach_nhaxuatban` FOREIGN KEY (`MaNXB`) REFERENCES `nhaxuatban` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `sach_tacgia`
--
ALTER TABLE `sach_tacgia`
  ADD CONSTRAINT `fk_sach_tacgia_sach` FOREIGN KEY (`ISBN13`) REFERENCES `sach` (`ISBN13`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ràng buộc cho bảng `sach_theloai`
--
ALTER TABLE `sach_theloai`
  ADD CONSTRAINT `fk_sach_theloai_sach` FOREIGN KEY (`ISBN13`) REFERENCES `sach` (`ISBN13`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
