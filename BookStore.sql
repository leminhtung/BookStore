USE [master]
GO
/****** Object:  Database [BookStore]    Script Date: 26/08/2018 9:13:11 CH ******/
CREATE DATABASE [BookStore]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'BookStore', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.MSSQLSERVER\MSSQL\DATA\BookStore.mdf' , SIZE = 5120KB , MAXSIZE = UNLIMITED, FILEGROWTH = 1024KB )
 LOG ON 
( NAME = N'BookStore_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL12.MSSQLSERVER\MSSQL\DATA\BookStore_log.ldf' , SIZE = 1024KB , MAXSIZE = 2048GB , FILEGROWTH = 10%)
GO
ALTER DATABASE [BookStore] SET COMPATIBILITY_LEVEL = 120
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [BookStore].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [BookStore] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [BookStore] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [BookStore] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [BookStore] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [BookStore] SET ARITHABORT OFF 
GO
ALTER DATABASE [BookStore] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [BookStore] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [BookStore] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [BookStore] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [BookStore] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [BookStore] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [BookStore] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [BookStore] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [BookStore] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [BookStore] SET  DISABLE_BROKER 
GO
ALTER DATABASE [BookStore] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [BookStore] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [BookStore] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [BookStore] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [BookStore] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [BookStore] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [BookStore] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [BookStore] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [BookStore] SET  MULTI_USER 
GO
ALTER DATABASE [BookStore] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [BookStore] SET DB_CHAINING OFF 
GO
ALTER DATABASE [BookStore] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [BookStore] SET TARGET_RECOVERY_TIME = 0 SECONDS 
GO
ALTER DATABASE [BookStore] SET DELAYED_DURABILITY = DISABLED 
GO
USE [BookStore]
GO
/****** Object:  Table [dbo].[Authors]    Script Date: 26/08/2018 9:13:11 CH ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Authors](
	[AuthorID] [int] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](50) NULL,
	[Description] [nvarchar](max) NULL,
	[Enabled] [bit] NOT NULL,
 CONSTRAINT [PK_Table_1] PRIMARY KEY CLUSTERED 
(
	[AuthorID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Books]    Script Date: 26/08/2018 9:13:11 CH ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Books](
	[BookID] [int] IDENTITY(1,1) NOT NULL,
	[BookName] [nvarchar](100) NULL,
	[Description] [nvarchar](max) NULL,
	[Picture] [nvarchar](100) NOT NULL,
	[Price] [decimal](19, 2) NOT NULL,
	[Quantity] [int] NOT NULL,
	[CategoryID] [int] NOT NULL,
	[AuthorID] [int] NOT NULL,
	[Enabled] [bit] NOT NULL,
 CONSTRAINT [PK_Books] PRIMARY KEY CLUSTERED 
(
	[BookID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Category]    Script Date: 26/08/2018 9:13:11 CH ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Category](
	[CategoryID] [int] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](50) NULL,
	[Enabled] [bit] NOT NULL,
 CONSTRAINT [PK_Category] PRIMARY KEY CLUSTERED 
(
	[CategoryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Comment]    Script Date: 26/08/2018 9:13:11 CH ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Comment](
	[CommentID] [int] IDENTITY(1,1) NOT NULL,
	[Contents] [nvarchar](max) NOT NULL,
	[UserID] [int] NOT NULL,
	[BookID] [int] NOT NULL,
	[Enabled] [bit] NOT NULL,
 CONSTRAINT [PK_Comment] PRIMARY KEY CLUSTERED 
(
	[CommentID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Orders]    Script Date: 26/08/2018 9:13:11 CH ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Orders](
	[OrderID] [int] IDENTITY(1,1) NOT NULL,
	[Status] [bit] NOT NULL,
	[Address] [nvarchar](600) NULL,
	[Phone] [varchar](100) NULL,
	[UsersID] [int] NOT NULL,
	[BookID] [int] NOT NULL,
	[CreateAt] [date] NULL,
	[Enabled] [bit] NOT NULL,
 CONSTRAINT [PK_Orders] PRIMARY KEY CLUSTERED 
(
	[OrderID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[OrdersDetail]    Script Date: 26/08/2018 9:13:11 CH ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[OrdersDetail](
	[OrderdetailID] [int] IDENTITY(1,1) NOT NULL,
	[UnitPrice] [decimal](19, 2) NOT NULL,
	[Quantity] [int] NOT NULL,
	[BookID] [int] NOT NULL,
	[OrderID] [int] NOT NULL,
 CONSTRAINT [PK_OrdersDetail] PRIMARY KEY CLUSTERED 
(
	[OrderdetailID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Roles]    Script Date: 26/08/2018 9:13:11 CH ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Roles](
	[RoleID] [int] IDENTITY(1,1) NOT NULL,
	[Name] [nvarchar](50) NULL,
	[UserID] [int] NOT NULL,
 CONSTRAINT [PK_Roles] PRIMARY KEY CLUSTERED 
(
	[RoleID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
/****** Object:  Table [dbo].[Users]    Script Date: 26/08/2018 9:13:11 CH ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[Users](
	[UserID] [int] IDENTITY(1,1) NOT NULL,
	[RoleId] [int] NULL,
	[PhoneNumber] [varchar](50) NOT NULL,
	[Password] [nvarchar](30) NOT NULL,
	[FirstName] [nvarchar](50) NULL,
	[LastName] [nvarchar](50) NULL,
	[Email] [nvarchar](50) NULL,
	[Address] [nvarchar](70) NULL,
	[Enabled] [bit] NOT NULL,
 CONSTRAINT [PK_Users] PRIMARY KEY CLUSTERED 
(
	[UserID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO
SET IDENTITY_INSERT [dbo].[Authors] ON 

INSERT [dbo].[Authors] ([AuthorID], [Name], [Description], [Enabled]) VALUES (1, N'Vũ Bằng', N'Vũ Bằng (3 tháng 6, 1913 – 7 tháng 4, 1984), tên thật là Vũ Thị Bằng, là một nhà văn, 
						nhà báo của Việt Nam. Ông là người có sở trường về viết truyện ngắn, tùy bút, bút ký. Ông đã vào Sài Gòn sau 1954 để làm báo và hoạt động tình báo. Ngoài bút hiệu Vũ Bằng, ông còn ký với các bút hiệu khác: Tiêu Liêu, Một Con Vịt, Thiên Thư, Vạn Lý Trình, Lê Tâm, Hoàng Thị Trâm. Nhà văn Vũ Bằng sinh ngày 3 tháng 6 năm 1913 tại Hà Nội và lớn lên trong một gia đình Nho học, quê gốc ở làng Lương Ngọc, huyện Bình Giang, tỉnh Hải Dương. 
							Ông theo học Trường Albert Sarraut, tốt nghiệp Tú Tài Pháp', 1)
INSERT [dbo].[Authors] ([AuthorID], [Name], [Description], [Enabled]) VALUES (2, N'Nguyễn Phương Mai', N'Nguyễn Phương Mai sinh ngày 27-11-1976 tại phố Lò Đúc, Hà Nội.
Phương Mai viết văn từ năm lớp 10 và là cây bút đóng góp cho báo Hoa Học Trò  những số đầu tiên. Năm 17 tuổi, Phương Mai ra tập truyện ngắn đầu tay có tên Đối diện. Hai năm sau khi tốt nghiệp Cao đẳng Sư phạm Hà Nội, Phương Mai trở thành thư ký tòa soạn báo Hoa Học Trò ở tuổi 24.
Nhưng Phương Mai sớm từ bỏ vị trí hấp dẫn đó để đi du học Hà Lan, giành học vị Thạc sĩ khoa học ngành Thiết kế giáo dục và Tiến sĩ ngành Giao tiếp đa văn hóa. Từ đó đến nay, Phương Mai là giảng viên tại khoa Kinh tế, Đại học Amsterdam, Hà Lan. Muốn làm “một hòn đá lăn không bám rêu”, Phương Mai đã đặt chân đến gần 80 quốc gia trên thế giới.
 ', 1)
INSERT [dbo].[Authors] ([AuthorID], [Name], [Description], [Enabled]) VALUES (3, N'Pierce Brown', N'PIERCE BROWN là tác giả người Mỹ, chuyên viết truyện giả tưởng. Sau khi tốt nghiệp đại học năm 2010, anh làm nhiều nghề khác nhau song song với nỗ lực sáng tác để trở thành nhà văn. Tác phẩm đầu tay Đỏ trỗi dậy ra đời năm 2014 đã thành công vang dội, được đón nhận tích cực bởi cả độc giả lẫn các nhà phê bình. Hiện Brown sống tại Los Angeles, cần mẫn viết những câu chuyện về tàu vũ trụ, phù thủy, ma quỷ cùng tất cả những thứ kỳ quặc, cổ xưa. Bộ ba Đỏ trỗi dậy gồm các cuốn: - Đỏ trỗi dậy (2014) - Đứa con Hoàng Kim (2015) - Sao Mai (2016)', 1)
INSERT [dbo].[Authors] ([AuthorID], [Name], [Description], [Enabled]) VALUES (4, N'Romain Gary', N'Sinh ngày 8-5-1914 tại Vilnius, Litva, Romain Gary lớn lên dưới sự nuôi dạy của mẹ. Ông chuyển đến sống tại Nice, Pháp, năm 14 tuổi. Sau khi theo học ngành Luật, ông đăng ký gia nhập Không quân Pháp. Trong chiến tranh thế giới thứ hai, ông là sĩ quan chỉ huy và từng được thưởng Bắc đẩu bội tinh.', 1)
INSERT [dbo].[Authors] ([AuthorID], [Name], [Description], [Enabled]) VALUES (5, N'Hiroshi Mikitani', N'Hiroshi Mikitani (sinh năm 1952): nhà sáng lập, chủ tịch và CEO của Rakuten, Inc., một trong những công ty thương mại điện tử và Internet của Nhật Bản đứng vào hàng những công ty tầm cỡ thế giới. Theo danh sách tỉ phú của tạp chí Forbes thì tổng tài sản của Hiroshi Mikitani được ước tính vào khoảng 8,7 tỉ đô la tính đến tháng Ba năm 2015.', 1)
INSERT [dbo].[Authors] ([AuthorID], [Name], [Description], [Enabled]) VALUES (6, N'Phạm Duy Khiêm', N'Phạm Duy Khiêm (1908-1974) là con trai của Phạm Duy Tốn, một trong những nhà văn viết truyện ngắn đầu tiên của Việt Nam đầu thế kỷ 20. Ông là người Việt đầu tiên tốt nghiệp tú tài văn chương Pháp và cũng là người Việt đầu tiên thi đậu trường Cao đẳng Sư phạm phố Ulm. Từ năm 1935, ông trở về Việt Nam dạy tiếng Pháp, tiếng Hy Lạp và tiếng Latinh tại trường Albert Sarraut, nơi ông nổi tiếng là người thầy cực kỳ nghiêm khắc. Sau hiệp định Genève năm 1954, ông nhận chức Bộ trưởng đặc nhiệm phủ thủ tướng Việt Nam Cộng Hòa. Từ năm 1955 đến 1957, ông quay lại Paris với tư cách Đại sứ Việt Nam Cộng hòa. Là một người cô đơn trong tình cảm, thất vọng vì không có đóng góp chính trị cho đất nước, bị giới văn chương hờ hững, Phạm Duy Khiêm lâm vào tuyệt vọng và tự sát ngày 30 tháng Mười một năm 1974.', 1)
INSERT [dbo].[Authors] ([AuthorID], [Name], [Description], [Enabled]) VALUES (7, N'Trình Tuấn', N'Trình Tuấn (sinh năm 1984, Tân Bình, TP.HCM) một mình chăm con gái từ những ngày sơ sinh. Dù bà nội và người thân muốn đón bé về quê chăm sóc, nhưng anh không chịu. Để con được bú sữa mẹ đầy đủ, anh Tuấn đã lên facebook, diễn đàn, hỏi khắp nơi để xin sữa từ các bà mẹ. Có những lúc đêm hôm, trời mưa gió, anh vẫn đi xe lên tận Quận 2 – cách nhà khoảng 20km để lấy sữa, dù ít nhưng cũng rất quý giá với con. Anh đã ròng rã xin sữa nuôi con cho đến tận hôm nay.', 1)
INSERT [dbo].[Authors] ([AuthorID], [Name], [Description], [Enabled]) VALUES (8, N'Minh Thi', N'Tốt nghiệp thạc sĩ ngành Truyền thông Toàn cầu tại Đại học Westminster, London nhờ học bổng Chevening của Bộ Ngoại giao Anh. Nhiều năm làm báo và dịch sách, gần đây tham gia giảng dạy về văn hóa và truyền thông, hiện làm công việc nghiên cứu văn hóa. Giành học bổng tiến sĩ toàn phần của Đại học Victoria Wellington, New Zealand. Yêu thích du lịch và tìm hiểu văn hóa, từng đặt chân đến gần 30 quốc gia trên thế giới. Trang cá nhân: minhthi.net', 1)
SET IDENTITY_INSERT [dbo].[Authors] OFF
SET IDENTITY_INSERT [dbo].[Books] ON 

INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (1, N'Phù Dung ơi vĩnh biệt', N'“Kiếp sống rõ não nùng. Tôi không sợ gì cả, nhưng sợ chết và sợ không được hút đúng giờ đúng giấc. ‘Nếu nghiện, ta đâm đầu xuống sông!’ Câu quyết định ngày nào vẫn còn lẩn vẩn trong trí nhớ, nhưng tôi tự thấy không còn sức để làm theo nữa... Đến bây giờ tôi mới biết rằng, thuốc phiện làm cho người ta muốn sống không được mà muốn chết cũng không được nữa.”', N'vubang1.jpg', CAST(68.00 AS Decimal(19, 2)), 10, 1, 1, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (2, N'Bóng ma nhà mệ hoát', N'“Bỗng nhiên tôi cảm thấy lành lạnh ở lưng. Ngồi thật yên lặng để nghe thì hình như có người đứng ở đâu gần đó. ‘Ủa, thế ra mệ Hoát và o Phương Thảo chưa đi à?’
Tôi quay lại, yên chí rằng hai cái bóng ma đứng ở cạnh tôi đọc những câu thơ tôi vừa viết lên mặt giấy. Hóa ra lầm. Đó chỉ là tiếng gió thở dài.”', N'vubang2.jpg', CAST(40.00 AS Decimal(19, 2)), 10, 1, 1, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (3, N'Bốn mươi năm nói láo', N'"NGƯỜI LÀM BÁO CHÂN CHÍNH  tranh đấu không cần ai khen, không sợ ai chửi hết". Người làm báo chân chính chiến đấu cho dân tộc, cho tương lai, có lúc nào rảnh rang chỉ ngồi nhìn lại quá khứ tự hỏi lòng mình có xứng đáng làm chiến sĩ không và chiến sĩ mức độ nào thôi...
Tôi tưởng như trông thấy những người bạn suốt đời viết báo, suốt đời khổ như Tản Đà, Văn Sen, Vũ Trọng Phụng, Lan Khai, Lê Văn Trương, Đinh Hùng, nay đã chết rồi mà vẫn còn cứ ôm ngòi bút viết bài nơi âm phủ"', N'vubang3.jpg', CAST(68.00 AS Decimal(19, 2)), 20, 1, 1, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (4, N'Món lạ miền nam', N'Trong “Món lạ miền Nam”, Vũ Bằng viết: “Tôi yêu miếng lạ miền Nam nhiều là vì nó lạ - lạ đến nhiều khi không thể tưởng tượng được – và chính những cái lạ đó đã cho tôi thấy rõ hơn tính chất thực thà, bộc lộ và chất phác của người Nam”.
Trong sách này, Vũ Bằng kể 8 món (canh rùa, thịt chuột, khô, đuông, cháo cóc, dơi huyết, bò kiến – thịt bò cho kiến bu, tóp mỡ ngào đường) mà ông cho là những món lạ làm cho lòng “thấy thương mến miền Nam, miếng ăn của miền Nam”. 
Thật ra, “cái lạ” chỉ là một điểm nổi lên trên cái nền hoang dã. Những người rời quê cũ lên mở cõi, khẩn hoang cùng đất mới gặp biết bao khó khăn, thiếu thốn đâu dễ gì giữ được phong vị quê xưa. Nhớ chiếc bánh đa, nhưng không có cối xay bột bánh tráng, đành phải tìm bọng cây bỏ cơm nếp (cơm nếp mềm dễ giã hơn cơm tẻ) vào giã nhuyễn cán ra thành chiếc bánh phồng. Và chính chiếc bánh phồng hoang dã này đã đẻ ra chiếc bánh phồng tôm công nghiệp ngày nay. Không có nhà cửa khang trang đặt bàn thờ ông bà để xếp lên những chiếc bánh chưng ngày tết, thôi biến chiếc bánh vuông thành chiếc bánh tét tròn và dài, cột từng đôi treo lên chạc cây rừng ở đầu nhà. Mọi thứ lá rừng, cây hoang nếm thử không ngộ độc thì đều rau ăn.', N'vubang4.jpg', CAST(35.00 AS Decimal(19, 2)), 30, 1, 1, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (5, N'Thương nhớ mười hai', N'“Nhớ lại có những đêm tháng mười ở Hà Nội, vợ chồng còn sống cạnh nhau, cứ vào khoảng này thì mặc áo ấm dắt 
nhau đi trên đường khuya tìm cao lâu quen ăn với nhau một bát tam xà đại hội có lá chanh và miến rán giòn tan, 
người chồng lạc phách đêm nay nhớ vợ cũng đóng cửa lại đi tìm một nhà hàng nào bán thịt rắn để nhấm nháp một 
mình và tưởng tượng như hãy còn ngồi ăn với người vợ thương yêu ngày trước, nhưng sao đi tìm mãi, đi tìm hoài 
không thấy […]
Người chồng dừng lại, sợ chính bóng mình. Nước mắt anh lại ứa ra, và chảy dài theo lối đi lấp loáng một bông sao 
rụng.”', N'vubang5.jpg', CAST(60.00 AS Decimal(19, 2)), 20, 1, 1, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (6, N'Miếng ngon Hà Nội', N'“Gió về khuya lạnh hơn, như gợi những niềm xa vắng. Vợ đặt hai cây bài xuống chiếu và cười:
- Kết đây, ông ơi!
- Kết gì?
- Tốt đen! Tôi ăn kết tốt đen đây!
Người chồng thở dài, làm ra bộ thua, nhưng một lát sau xòe ra hai cây tốt đỏ, không nói gì. Và người vợ đỏ mặt lên - hai má tươi như hoa đào.
- Thế là bị đè rồi!
Người chồng đắc ý cười vang, nhấp thêm một chút nước trà sen; đoạn, thong thả lấy ngón tay cái và ngón tay trỏ nhón một chiếc bánh xuân cầu màu hoàng yến đưa lên miệng...”', N'vubang6.jpg', CAST(41.00 AS Decimal(19, 2)), 30, 1, 1, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (7, N'Tôi là một con lừa', N'
“Trước mỗi lần lên đường, tôi cố gắng trút bỏ mọi định kiến, mọi hình dung. Tôi dốc cạn để đầu óc trỗng rỗng, không mong chờ, không phán đoán.
Tôi liều mạng để trái tim mình rộng mở, trần trụi.
Và tôi lên đường như một tờ giấy trắng, với niềm khát khao được phủ kín, được lấp đầy, được đổi thay.”', N'npm1.jpg', CAST(54.00 AS Decimal(19, 2)), 30, 1, 2, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (8, N'Chó trắng', N'Vô tình bước vào cuộc đời của nhà văn và vợ, Batka mau chóng chiếm được tình yêu của  Romain Gary. Gắn bó với con chó, nhà văn đau đớn khi phát hiện ra rằng Batka là một con Chó trắng – một trong những chú chó được huấn luyện đặc biệt để tấn công người da đen. Không muốn giải quyết đời chú bằng một mũi tiêm thuốc độc, Romain Gary quyết tâm “chữa” cho Chó Trắng. Nhưng rồi Batka sẽ ra sao khi rơi vào tay một người huấn luyện da đen?
Ra đời trong bối cảnh tại Mỹ đang diễn ra những cuộc bạo động phản đối nạn phân biệt chủng tộc, Chó Trắng còn đi xa hơn thế. Một cách không khoan nhượng, với sự sáng suốt và tinh tế, tác giả của Lời hứa lúc bình minh đã xử lý một chủ đề đạo đức với sự thấu cảm văn chương tuyệt vời. Với Romain Gary, viết không giúp tìm ra câu trả lời, nhưng viết giúp giải tỏa nỗi đau trước sự ngu ngốc của con người.', N'gary1.jpg', CAST(77.00 AS Decimal(19, 2)), 30, 2, 3, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (9, N'Tôi bỏ quên tôi ở nước anh', N'Tôi bỏ quên tôi ở nước Anh của Minh Thi, như một-truyện-tình, mơ màng nhưng thật sống động, của một du học sinh đối với nước Anh, xứ sở dù chia tay nhưng đã nằm trọn trong trái tim cô. Ở đó, bạn sẽ được thưởng ngoạn các nghệ sĩ trổ tài ngay trên các đường phố tấp nập của London, lướt qua các quán rượu để nghe tiếng chuyện trò rôm rả và tiếng chạm cốc leng keng vào giờ tan tầm, hay đôi khi dạo chơi thong thả qua những con phố nép mình giữa hai hàng tường đá rêu phong và vùng thôn quê xanh mơ của thành phố Edinburgh cổ kính. Bạn cũng sẽ biết người Anh nghĩ gì, muốn gì, và cần phải cẩn trọng như thế nào để không bị lố khi nói chuyện với họ. Bằng một lối viết dung dị nhưng lạ lẫm, đan cài cả du ký, hồi ký,  khảo cứu văn hóa và không quên những cẩm nang nho nhỏ về du lịch, Minh Thi không chỉ kể với chúng ta câu chuyện của mình ở nước Anh, mà còn dày công tìm hiểu văn hóa Anh, hiểu thói quen, sở thích của người Anh, để rồi đất nước này hiện lên qua con mắt cô nhiều lúc chân thực đến gai người. Đọc Tôi bỏ quên tôi ở nước Anh, để khó lòng dứt ra khỏi những mẩu chuyện duyên dáng cùng những nhận xét tinh tế, hài hước của cô, về một xứ sở vừa quen vừa lạ…', N'minhthi1.jpg', CAST(65.00 AS Decimal(19, 2)), 35, 1, 8, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (10, N'Con đường hồi giáo', N'
Giới thiệu sách
Con Đường Hồi Giáo
"Bởi tôi biết còn có rất nhiều điều thiêng liêng hơn niềm tin tôn giáo, ấy là niềm tin vào sự ràng buộc cội rễ của giống loài; vào sự giống nhau giữa người với người hơn là sự khác biệt về đức tin; vào lòng tốt; vào sự đồng cảm và hướng thiện.
Tôi tin là một khi đặt chân đến Trung Đông, với trái tim này mở toang không che giấu, những người Hồi rồi cũng sẽ mở lòng với tôi - một cô gái Việt Nam vô thần."', N'npm2.jpg', CAST(72.00 AS Decimal(19, 2)), 40, 1, 2, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (11, N'Đỏ trỗi dậy 2: Đứa con hoàng kim', N'
Giới thiệu sách
Là tập hai của bộ Đỏ trỗi dậy, Đứa Con Hoàng Kim tiếp nối thiên sử thi tráng lệ về Darrow, kẻ nổi loạn được trui rèn bởi thảm kịch. Trưởng thànhdưới các mỏ sâu trong lòng Sao Hỏa,lần đầu tiên được nhìn thấy mặt trời cũng là lúc Darrow phát hiện tín ngưỡng củagiống loài mình bấy lâu nay chỉ là một lời nói dối khổng lồ. Biết rằng nổi dậy là con đường giải phóng duy nhất, cậuliềuđem thân mình để tạo tác thành Hoàng Kim, với một kế hoạch xâm nhậptiềm ẩn nhiều bất trắc…', N'brown1.jpg', CAST(134.00 AS Decimal(19, 2)), 30, 2, 3, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (12, N'Đỏ trỗi dậy', N'Tác phẩm hay nhất năm 2014 do Entertaiment Weekly, Buzzfeed và Shelf Awarness bình chọn
Trái Đất đang chết dần. Dưới những tầng đất sâu của Sao Hỏa, có một cộng đồng những con người mắt và tóc đỏ quạch như màu của hành tinh mà họ đang sống. Nhiệm vụ của họ là khai thác Helium 3 - một thứ nguyên tố được cho là sẽ biến bề mặt Sao Hỏa thành nơi con người có thể sinh sống được. Họ là niềm hy vọng cuối cùng của nhân loại. Họ là Đỏ.
Ngoại trừ… tất cả là một lời nói dối khổng lồ. Các Đỏ không phải những người tiên phong. Họ chỉ là những nô lệ bị lợi dụng làm việc quần quật cho đến chết!
Đỏ trỗi dậy phảng phất đâu đó những nét quen thuộc với các độc giả của Đấu trường sinh tử, Chúa ruồi, Trò chơi của Ender hay Trò chơi vương quyền. Nhưng đây vẫn là một cuốn sách hết sức khác biệt. Hồi hộp đến nghẹt thở, bất ngờ đến choáng váng, tàn nhẫn đến lạnh người. Rơi xuống chói lòa như một ngôi sao băng và cuốn ta đi như một cơn bão. ', N'brown2.jpg', CAST(96.00 AS Decimal(19, 2)), 42, 2, 3, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (14, N'Nam và Sylvie', N'', N'khiem1.jpg', CAST(60.00 AS Decimal(19, 2)), 32, 3, 6, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (15, N'Ba muốn nuôi con bằng sữa mẹ', N'"Ít ra cuộc đời đã không lấy đi của ba tất cả, ba vẫn còn Ủn để nhớ, để thương, để quay về bình lặng sau cơn sóng dữ. Ủn là hạnh phúc của ba, là tất cả với ba bây giờ. Thật đáng sợ khi không còn gì bám víu trong lòng nước dữ, con người ta sẽ để mặc cho dòng đời cuốn đi. Ba sẽ thành kẻ đầu đường xó chợ, hay có thể là kẻ tâm thần ăn mày dĩ vãng, hay tệ hơn mà ai biết...Cảm ơn con đã níu ba lại để ba không gục ngã, để hôm nay nhận thấy tim mình còn thổn thức vì con."', N'tuan1.jpg', CAST(54.00 AS Decimal(19, 2)), 30, 3, 7, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (16, N'Hồi sinh sự thần kỳ Nhật Bản', N'Cuốn sách là những cuộc đối thoại của hai cha con Mikitani về công cuộc tái kiến thiết Nhật Bản dựa trên nền tảng là đề xuất “Lại là Nhật Bản” của Hiroshi Mikitani với vai trò là thành viên của Hội đồng Sức Cạnh tranh Quy mô Ngành nghề - một trong ba hội đồng đóng vai trò kiểm soát cho kế hoạch hồi sinh nền kinh tế (Abenomics) của Thủ tướng Abe. Một giáo sư kinh tế và một doanh chủ đã đưa ra những nhận xét, đánh giá về mọi mặt của xã hội Nhật Bản hiện đại, từ kinh tế tới giáo dục, y tế, việc làm; đồng thời đề xuất các giải pháp tương ứng cho từng vấn đề đó. Không hề lạc quan, tự mãn trước những thành tựu của đất nước, hai cha con Mikitani đã chỉ ra những bước thụt lùi, những thất bại của Nhật Bản. Có thể nói, những đối thoại của họ không chỉ là sự phê phán sâu sắc với xã hội Nhật Bản, mà còn là sự phẫu tích cho từng vấn đề mà Nhật Bản đang phải đối mặt, với mong muốn rằng việc đưa ra cuốn sách “sẽ giúp mọi người nhận ra tình thế khó khăn mà Nhật Bản đang phải đối mặt, cũng như đưa ra tầm nhìn về một tương lai tươi sáng hơn và lộ trình để tới đó”.', N'hiroshi.jpg', CAST(83.00 AS Decimal(19, 2)), 20, 3, 5, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (17, N'anime6', N'zzzzzzz', N'5d31e49fada653798f7c8f4c47f65d14.jpg', CAST(555.00 AS Decimal(19, 2)), 23, 1, 1, 0)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (18, N'hungggg', N'csssss', N'3480d6306e04df9da045aa39567b778f.jpg', CAST(98.65 AS Decimal(19, 2)), 3, 4, 5, 0)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (19, N'sách m?i', N'qă', N'3480d6306e04df9da045aa39567b778f.jpg', CAST(40.00 AS Decimal(19, 2)), 2, 4, 6, 0)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (20, N'hi', N'abcokocakockoakc', N'35797c8ff67cf27d6d8843cd9f395724.jpg', CAST(555.00 AS Decimal(19, 2)), 45309, 2, 2, 0)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (22, N'cat', N'hello', N'f1a263e48b118f0fe8014483b0534edf.jpg', CAST(0.00 AS Decimal(19, 2)), 4, 2, 4, 0)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (23, N'Sách mới', N'hello', N'37378824_232158934070570_687531424076529664_o.jpg', CAST(50.00 AS Decimal(19, 2)), 45, 1, 4, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (24, N'hello', N'test', N'abb02ed5db6092f24cbc5e6ddffb17b1.jpg', CAST(30.00 AS Decimal(19, 2)), 20, 1, 5, 1)
INSERT [dbo].[Books] ([BookID], [BookName], [Description], [Picture], [Price], [Quantity], [CategoryID], [AuthorID], [Enabled]) VALUES (25, N'anime6', N'anime', N'3480d6306e04df9da045aa39567b778f.jpg', CAST(20.00 AS Decimal(19, 2)), 5, 5, 8, 1)
SET IDENTITY_INSERT [dbo].[Books] OFF
SET IDENTITY_INSERT [dbo].[Category] ON 

INSERT [dbo].[Category] ([CategoryID], [Name], [Enabled]) VALUES (1, N'Văn học Việt Nam', 1)
INSERT [dbo].[Category] ([CategoryID], [Name], [Enabled]) VALUES (2, N'Văn Nước Ngoài', 1)
INSERT [dbo].[Category] ([CategoryID], [Name], [Enabled]) VALUES (3, N'Thời sự - Chính trị', 1)
INSERT [dbo].[Category] ([CategoryID], [Name], [Enabled]) VALUES (4, N'Khoa học tự nhiên - Nhân văn', 1)
INSERT [dbo].[Category] ([CategoryID], [Name], [Enabled]) VALUES (5, N'Tham Khảo', 1)
SET IDENTITY_INSERT [dbo].[Category] OFF
SET IDENTITY_INSERT [dbo].[Comment] ON 

INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (3, N'sadasdasd', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (4, N'sadasdasd', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (5, N'sadasdasd', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (6, N'sadasdasd', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (7, N'sadasdasd', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (8, N'sadasdasd', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (9, N'sadasdasd', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (10, N'hi', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (11, N'hi', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (12, N'hi', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (13, N'hey', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (14, N'hey', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (15, N'Sach do vai ca lonnnnnnnnnnn', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (16, N'Sach hay ma thang tac gia xau trai vai', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (17, N'Sach hay ma thang tac gia xau trai vai', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (18, N'may noi dung, tac gia xau trai vai', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (20, N'sách hay', 2, 2, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (21, N'Comment', 2, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (22, N'sách rất hay', 3, 4, 1)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (23, N'Sách rất hay', 3, 1, 0)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (24, N'sách rất hay
', 3, 1, 1)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (25, N'hi', 3, 2, 1)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (26, N'Sách rất hay', 3, 6, 1)
INSERT [dbo].[Comment] ([CommentID], [Contents], [UserID], [BookID], [Enabled]) VALUES (27, N'tôi thích nó', 4, 2, 1)
SET IDENTITY_INSERT [dbo].[Comment] OFF
SET IDENTITY_INSERT [dbo].[Orders] ON 

INSERT [dbo].[Orders] ([OrderID], [Status], [Address], [Phone], [UsersID], [BookID], [CreateAt], [Enabled]) VALUES (1, 1, N'CMT8', N'01232559989', 1, 1, NULL, 1)
INSERT [dbo].[Orders] ([OrderID], [Status], [Address], [Phone], [UsersID], [BookID], [CreateAt], [Enabled]) VALUES (2, 1, N'q7', N'01232559989', 3, 23, NULL, 1)
SET IDENTITY_INSERT [dbo].[Orders] OFF
SET IDENTITY_INSERT [dbo].[OrdersDetail] ON 

INSERT [dbo].[OrdersDetail] ([OrderdetailID], [UnitPrice], [Quantity], [BookID], [OrderID]) VALUES (1, CAST(68000.00 AS Decimal(19, 2)), 3, 1, 1)
INSERT [dbo].[OrdersDetail] ([OrderdetailID], [UnitPrice], [Quantity], [BookID], [OrderID]) VALUES (2, CAST(50000.00 AS Decimal(19, 2)), 2, 23, 2)
SET IDENTITY_INSERT [dbo].[OrdersDetail] OFF
SET IDENTITY_INSERT [dbo].[Users] ON 

INSERT [dbo].[Users] ([UserID], [RoleId], [PhoneNumber], [Password], [FirstName], [LastName], [Email], [Address], [Enabled]) VALUES (1, 1, N'1232559989', N'tung123', N'Tung', N'Le', N'Tung@gmail.com', N'cmt8', 1)
INSERT [dbo].[Users] ([UserID], [RoleId], [PhoneNumber], [Password], [FirstName], [LastName], [Email], [Address], [Enabled]) VALUES (2, 0, N'0123456789', N'123', N'trong', N'quang', N'quang@gmail.com', N'cmt8', 1)
INSERT [dbo].[Users] ([UserID], [RoleId], [PhoneNumber], [Password], [FirstName], [LastName], [Email], [Address], [Enabled]) VALUES (3, 0, N'01232559989', N'123', N'Tung', N'Minh', N'MinhTung@gmail.com', N'Q7', 1)
INSERT [dbo].[Users] ([UserID], [RoleId], [PhoneNumber], [Password], [FirstName], [LastName], [Email], [Address], [Enabled]) VALUES (4, 9, N'0987654321', N'123456', N'Ho', N'Phuong', N'minhtung111@gmail.com', NULL, 1)
SET IDENTITY_INSERT [dbo].[Users] OFF
ALTER TABLE [dbo].[Books]  WITH CHECK ADD  CONSTRAINT [FK_Books_Authors] FOREIGN KEY([AuthorID])
REFERENCES [dbo].[Authors] ([AuthorID])
GO
ALTER TABLE [dbo].[Books] CHECK CONSTRAINT [FK_Books_Authors]
GO
ALTER TABLE [dbo].[Books]  WITH CHECK ADD  CONSTRAINT [FK_Books_Category] FOREIGN KEY([CategoryID])
REFERENCES [dbo].[Category] ([CategoryID])
GO
ALTER TABLE [dbo].[Books] CHECK CONSTRAINT [FK_Books_Category]
GO
ALTER TABLE [dbo].[Comment]  WITH CHECK ADD  CONSTRAINT [FK_Comment_Books] FOREIGN KEY([BookID])
REFERENCES [dbo].[Books] ([BookID])
GO
ALTER TABLE [dbo].[Comment] CHECK CONSTRAINT [FK_Comment_Books]
GO
ALTER TABLE [dbo].[Comment]  WITH CHECK ADD  CONSTRAINT [FK_Comment_Users] FOREIGN KEY([UserID])
REFERENCES [dbo].[Users] ([UserID])
GO
ALTER TABLE [dbo].[Comment] CHECK CONSTRAINT [FK_Comment_Users]
GO
ALTER TABLE [dbo].[Orders]  WITH CHECK ADD  CONSTRAINT [FK_Orders_Books] FOREIGN KEY([BookID])
REFERENCES [dbo].[Books] ([BookID])
GO
ALTER TABLE [dbo].[Orders] CHECK CONSTRAINT [FK_Orders_Books]
GO
ALTER TABLE [dbo].[Orders]  WITH CHECK ADD  CONSTRAINT [FK_Orders_Users] FOREIGN KEY([UsersID])
REFERENCES [dbo].[Users] ([UserID])
GO
ALTER TABLE [dbo].[Orders] CHECK CONSTRAINT [FK_Orders_Users]
GO
ALTER TABLE [dbo].[OrdersDetail]  WITH CHECK ADD  CONSTRAINT [FK_OrdersDetail_Books] FOREIGN KEY([BookID])
REFERENCES [dbo].[Books] ([BookID])
GO
ALTER TABLE [dbo].[OrdersDetail] CHECK CONSTRAINT [FK_OrdersDetail_Books]
GO
ALTER TABLE [dbo].[OrdersDetail]  WITH CHECK ADD  CONSTRAINT [FK_OrdersDetail_Orders] FOREIGN KEY([OrderID])
REFERENCES [dbo].[Orders] ([OrderID])
GO
ALTER TABLE [dbo].[OrdersDetail] CHECK CONSTRAINT [FK_OrdersDetail_Orders]
GO
ALTER TABLE [dbo].[Roles]  WITH CHECK ADD  CONSTRAINT [FK_Roles_Users] FOREIGN KEY([UserID])
REFERENCES [dbo].[Users] ([UserID])
GO
ALTER TABLE [dbo].[Roles] CHECK CONSTRAINT [FK_Roles_Users]
GO
USE [master]
GO
ALTER DATABASE [BookStore] SET  READ_WRITE 
GO
