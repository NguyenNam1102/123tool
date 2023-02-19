<?php
/**
 * @package Cấu hình Thẻ siêu rẻ
 *
 * @author Vinh Developer | Ske Software | Phạm Vinh ID
 *
 * @see Lưu ý: Token captcha phải được lấy chính xác thì mới có thể đăng nhập được vào tài khoản ! Cách lấy xin liên hệ Zalo: 0931562864 - Vinh Developer hoặc xem trong phần Hướng dẫn
 *
 * @method Nếu lỗi đăng nhập: Mã xác nhận không chính xác thì token captcha bị sai và phải lấy lại
 */
namespace SkeSoft;
class Config {
	// Ghi lại nhật ký hoạt động (true nếu có hoặc false nếu không)
	public const LOGGING = true;

	// Cài đặt tài khoản (bắt buộc)
	public const TSR_USERNAME = '0366483817'; // Username tài khoản thẻ siêu rẻ
	public const TSR_PASSWORD = 'v2i0n0h7'; // Mật khẩu thẻ siêu rẻ

	// Tự động xóa file lưu cookie (true nếu bật hoặc false nếu tắt, khuyến khích nên để false)
	public const AUTO_DELETE_COOKIE = false; // Tính năng này sẽ lưu cookie tài khoản trong 1 thời gian dài để đăng nhập không cần captcha token, nếu bạn đổi tài khoản tsr bắt buộc phải xóa cookie. Cách xóa cookie xem trong hướng dẫn.

	// Token captcha ở thẻ siêu rẻ (bắt buộc, cách lấy token ở hướng dẫn)
	public const G_CAPTCHA_CODE = '03AD1IbLCNYTUelwYviyIVxzp-RoLxN40puuYIXncr4HmENs4r-29Jh5tOwGN4hqWfGHzvhGGcNEfiRbdidjQwqqL0Qskr6hp6ZpxbaH1DebEIfubumERQw8Dh7FKc22xpNE5pJEJcbVqi9ko6KVPE3msRB3h2O2f8JZVeOTVuNEZ_fVY4JJo5Scn7LtzxPB5jODPxYyrx3XHtGvbMACNWMSDJ5BzINB4M9EsEnyHUVCzluFwziTZ7jBHU4DC_WQcLMrEGrlFFzL0y7JqgNAVMNG_bMXjUaQMaTmLQw2lRqgVCwid9pFQoRBZScKCzTHHdAlv4xHrrd4fqG2d4U8_4BbhrClLkG3TLOc0OC-kr4IKDZkY7DgXvqCetohAtKwp7Ur52Sj9hiEFgMqKp1WNwEtWjDxmU1Jf48yVQrwbjGXpFkRtZH5fcXAzzhCLuB-lSQqM3PgVYzFMvh4_if4KsoGe4hFP-bKb5-YPFpkLaEDyr4Z3oRCgoG-mHDQFddIf92g74ryJLCsJtFv5I1oflFAK-SB6Vlb6RqpYS13yKysRpJ-ROeul018CfdY7EewB8UltHMu-U7gNrswdTxZTSAah34PfFVV5aGQ';
}