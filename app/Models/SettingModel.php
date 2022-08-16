<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DataTrait;
use DB;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class SettingModel extends Model implements AuditableContract {

	/**
	 * The database table used by the model.
	 * 
	 * @var string
	 */
	use DataTrait;
	
	use \OwenIt\Auditing\Auditable;
	
	protected $table = 'setting';

	protected $primaryKey = 'id';

	const CREATED_AT = 'settings_created_at';

	const UPDATED_AT = 'settings_updated_at';

	protected $fillable = array(
							'home_page_title','home_page_title_arabic','career_page_title','contact_page_title','sitename','sitelogo_english','sitelogo_arabic','sublogo_english','sublogo_arabic',
							'location_map','location_map_file_ext','employee_webmail','site_meta_title','site_meta_description','site_meta_keyword','career_meta_description',
							'career_meta_keyword','career_meta_author','contact_meta_description','contactus_meta_title','contact_meta_keyword','contact_meta_author',
							'default_lang','disable_language','enquiry_send_email','facebook_link','twitter_link','pinterest_link','instagram_link','google_plus_link','vimeo_link','youtube_link','linkedin_link',
							'news_page_banner','news_count','company_brochure','map_longitude','map_latitude','show_iframe_google_map','address1','address2','address3',
							'phone','fax','disable_arabic','twitterDisplayCount','showTwitterFeeds','email','googleCaptchaSiteKey','registeration_expiry_date',
							'tweet_last_updated','start_reg_no','current_reg_no','twitter_hash_tag','featured_news_limit','site_meta_description_arabic','site_meta_keyword_arabic','site_meta_title_arabic','live_now_status'
					);

	public static function get_website_settings(){

		return  DB::table('setting')->first();

	}





}
