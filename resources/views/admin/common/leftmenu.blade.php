<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
		<div class="logoWrapper">
			 <img src="{{ getWebsiteLogo() }}" />
		</div>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">{{ lang('dashboard') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        {{ lang('menu') }}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ get_admin_menu_active_class($currentURI,['dashboard']) }}" href="{{ apa('dashboard') }}"><i class="fas fa-chart-pie"></i>{{ lang('dashboard') }}</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link {{ get_admin_menu_active_class($currentURI,['menu_manager']) }}" href="{{ apa('menu_manager') }}"><i class="fas fa-chart-pie"></i>{{ lang('menu') }}</a>
                    </li>
					<?php /*
<li class="nav-item">
<a class="nav-link {{ get_admin_menu_active_class($currentURI,['category_manager']) }}" href="{{ apa('category_manager') }}"><i class="fas fa-chart-pie"></i>{{ lang('category_manager') }}</a>
</li>
 */?>

					<li class="nav-item">
							<a class="nav-link {{ get_admin_menu_active_class($currentURI,['banners','digital_laws_in_uae','terms_of_use','digital_domains','about_us','about_us_questions','digital_citizenship','parent_guide_intro','parent_guides','educator_guide_intro','educator_guides','guides_and_tips','guides_and_tips','news-opinion','resources','brought_to_you_by','proudly_supported_by','events','contact_us']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#cms_controls" aria-controls="submenu-1-1"><i class=" fas fa-book"></i>CMS</a>
							<div id="cms_controls" class="collapse submenu" style="">
								<ul class="nav flex-column">
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['banners']) }}" href="{{ apa('post/banners') }}"><i class="fas fa-image"></i>{{ lang('banners') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['digital_domains']) }}" href="{{ apa('post/digital_domains') }}"><i class="fas fa-image"></i>{{ lang('digital_domains') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['about_digital_wellbeing']) }}" href="{{ apa('post/about_digital_wellbeing/') }}"><i class="fas fa-image"></i>{{ lang('about_digital_wellbeing') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['about_us']) }}" href="{{ apa('post/about_us/') }}"><i class="fas fa-image"></i>{{ lang('about_us') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['about_us_questions']) }}" href="{{ apa('post/about_us_questions') }}"><i class="fas fa-image"></i>{{ lang('about_us_questions') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['digital_citizenship']) }}" href="{{ apa('post/digital_citizenship/') }}"><i class="fas fa-image"></i>{{ lang('digital_citizenship') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['sannif-online']) }}" href="{{ apa('post/sannif-online/') }}"><i class="fas fa-image"></i>Sannif Online Classification</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['youtube_gallery']) }}" href="{{ apa('post/youtube_gallery') }}"><i class="fas fa-image"></i>{{ lang('youtube_gallery') }}</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['parent_guide_intro','parent_guides']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#parent_controls" aria-controls="submenu-1-1">
											<i class=" fas fa-image"></i>{{ lang('parents') }}
										</a>
										<div id="parent_controls" class="collapse submenu" style="">
											<ul class="nav flex-column">
												<li class="nav-item">
													<a class="nav-link {{ get_admin_menu_active_class($currentURI,['parent_guide_intro']) }}" href="{{ apa('post/parent_guide_intro') }}"><i class="fas fa-image"></i>{{ lang('parent_guide_intro') }}</a>
												</li>
												<li class="nav-item">
													<a class="nav-link {{ get_admin_menu_active_class($currentURI,['parent_guides']) }}" href="{{ apa('post/parent_guides') }}"><i class="fas fa-image"></i>{{ lang('parent_guides') }}</a>
												</li>
											</ul>
										</div>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['educator_guide_intro','educator_guides']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#educator_controls" aria-controls="submenu-1-1">
											<i class=" fas fa-image"></i>{{ lang('educators') }}
										</a>
										<div id="educator_controls" class="collapse submenu" style="">
											<ul class="nav flex-column">
												<li class="nav-item">
													<a class="nav-link {{ get_admin_menu_active_class($currentURI,['educator_guide_intro']) }}" href="{{ apa('post/educator_guide_intro') }}"><i class="fas fa-image"></i>{{ lang('educator_guide_intro') }}</a>
												</li>
												<li class="nav-item">
													<a class="nav-link {{ get_admin_menu_active_class($currentURI,['educator_guides']) }}" href="{{ apa('post/educator_guides') }}"><i class="fas fa-image"></i>{{ lang('educator_guides') }}</a>
												</li>
											</ul>
										</div>
									</li>
									<li>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['guides_and_tips']) }}" href="{{ apa('post/guides_and_tips') }}"><i class="fas fa-image"></i>{{ lang('guides_and_tips') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['news-opinion']) }}" href="{{ apa('post/news-opinion') }}"><i class="fas fa-image"></i>{{ lang('news_and_opinions') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['resources']) }}" href="{{ apa('post/resources') }}"><i class="fas fa-image"></i>{{ lang('resources') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['stories']) }}" href="{{ apa('post/stories') }}"><i class="fas fa-image"></i>{{ lang('stories') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['brought_to_you_by']) }}" href="{{ apa('post/brought_to_you_by') }}"><i class="fas fa-image"></i>{{ lang('brought_to_you_by') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['proudly_supported_by']) }}" href="{{ apa('post/proudly_supported_by') }}"><i class="fas fa-image"></i>{{ lang('proudly_supported_by') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['supported_by']) }}" href="{{ apa('post/supported_by') }}"><i class="fas fa-image"></i>{{ lang('supported_by') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['digital_laws_in_uae']) }}" href="{{ apa('post/digital_laws_in_uae') }}"><i class="fas fa-image"></i>{{ lang('digital_laws_in_uae') }}</a>
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['terms_of_use']) }}" href="{{ apa('post/terms_of_use') }}"><i class="fas fa-image"></i>{{ lang('terms_of_use') }}</a>

									</li>
								</ul>
							</div>
					</li>

					<li class="nav-item"><a class="nav-link {{ get_admin_menu_active_class($currentURI,['events']) }}" href="{{ apa('post/our-events') }}"><i class="fas fa-image"></i>{{ lang('our_initiative') }}</a></li>
					<li class="nav-item"><a class="nav-link {{ get_admin_menu_active_class($currentURI,['contact-list']) }}" href="{{ apa('contact-list') }}"><i class="fas fa-image"></i>{{ lang('contact_us') }}</a></li>

					<li class="nav-item">
							<a class="nav-link {{ get_admin_menu_active_class($currentURI,['determination','determination_article','determination_blog']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#determination_controls" aria-controls="submenu-1-1"><i class=" fas fa-lock"></i>Manage Determination</a>
							<div id="determination_controls" class="collapse submenu" style="">
								<ul class="nav flex-column">
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,'determination') }}" href="{{ apa('post/determination') }}"><i class="fas fa-users"></i>About Determination</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,'determination_article') }}" href="{{ apa('post/determination_article') }}"><i class="fas fa-users"></i>Manage Articles</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,'determination_blog') }}" href="{{ apa('post/determination_blog') }}"><i class="fas fa-users"></i>Manage Blogs</a>
									</li>

								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a class="nav-link {{ get_admin_menu_active_class($currentURI,['young_people','young_people_article','young_people_blog','young-people-guides']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#young_people_controls" aria-controls="submenu-1-1"><i class=" fas fa-lock"></i>Manage Young People</a>
							<div id="young_people_controls" class="collapse submenu" style="">
								<ul class="nav flex-column">
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,'young_people') }}" href="{{ apa('post/young_people') }}"><i class="fas fa-users"></i>About Young People</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,'young_people_article') }}" href="{{ apa('post/young_people_article') }}"><i class="fas fa-users"></i>Manage Articles</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,'young_people_blog') }}" href="{{ apa('post/young_people_blog') }}"><i class="fas fa-users"></i>Manage Blogs</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,'young-people-guides') }}" href="{{ apa('post/young-people-guides') }}"><i class="fas fa-users"></i>Manage Guides</a>
									</li>

								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a class="nav-link {{ get_admin_menu_active_class($currentURI,['be_an_esafe_kid','i_want_help_with','how_esafety_can_help']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#children_controls" aria-controls="submenu-1-1"><i class=" fas fa-lock"></i>Manage Children</a>
							<div id="children_controls" class="collapse submenu" style="">
								<ul class="nav flex-column">
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['be_an_esafe_kid','be_an_esafe_kid_article']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#esafe_kid_controls" aria-controls="submenu-1-1">
											<i class=" fas fa-image"></i>Be an eSafe kid
										</a>
										<div id="esafe_kid_controls" class="collapse submenu" style="">
											<ul class="nav flex-column">
												<li class="nav-item">
													<a class="nav-link {{ get_admin_menu_active_class($currentURI,['be_an_esafe_kid']) }}" href="{{ apa('post/be_an_esafe_kid') }}"><i class="fas fa-image"></i>Manage Categories</a>
												</li>
												<li class="nav-item">
													<a class="nav-link {{ get_admin_menu_active_class($currentURI,['be_an_esafe_kid_article']) }}" href="{{ apa('post/be_an_esafe_kid_article') }}"><i class="fas fa-image"></i>Manage Articles</a>
												</li>
											</ul>
										</div>
									</li>

									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['i_want_help_with_article']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#help_with_controls" aria-controls="submenu-1-1">
											<i class=" fas fa-image"></i>I want help with
										</a>
										<div id="help_with_controls" class="collapse submenu" style="">
											<ul class="nav flex-column">
												<li class="nav-item">
													<a class="nav-link {{ get_admin_menu_active_class($currentURI,['i_want_help_with_article']) }}" href="{{ apa('post/i_want_help_with_article') }}"><i class="fas fa-image"></i>Manage Articles</a>
												</li>
											</ul>
										</div>
									</li>

									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['kid_esafety','report_question','report-list']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#kid_esafety_controls" aria-controls="submenu-1-1">
											<i class=" fas fa-image"></i>How eSafety can help
										</a>
										<div id="kid_esafety_controls" class="collapse submenu" style="">
											<ul class="nav flex-column">
												<li class="nav-item">
													<a class="nav-link {{ get_admin_menu_active_class($currentURI,['kid_esafety']) }}" href="{{ apa('post/kid_esafety') }}"><i class="fas fa-image"></i>About eSafety</a>
												</li>
												<li class="nav-item">
													<a class="nav-link {{ get_admin_menu_active_class($currentURI,['report_question']) }}" href="{{ apa('post/report_question') }}"><i class="fas fa-image"></i>Report Questions</a>
												</li>
												<li class="nav-item">
													<a class="nav-link {{ get_admin_menu_active_class($currentURI,['report-list']) }}" href="{{ apa('report-list') }}"><i class="fas fa-image"></i>Report List</a>
												</li>
											</ul>
										</div>
									</li>																		
								</ul>
							</div>
						</li>						

					<li class="nav-item">
							<a class="nav-link {{ get_admin_menu_active_class($currentURI,['council-members','council-roles','about-council', 'about-council-facts']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#council_controls" aria-controls="submenu-1-1"><i class=" fas fa-lock"></i>Manage Council</a>
							<div id="council_controls" class="collapse submenu" style="">
								<ul class="nav flex-column">
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,'about-council') }}" href="{{ apa('post/about-council') }}"><i class="fas fa-users"></i>About Council</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,'about-council-facts') }}" href="{{ apa('post/about-council-facts') }}"><i class="fas fa-users"></i>About Council: Facts</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,'council-members') }}" href="{{ apa('post/council-members') }}"><i class="fas fa-users"></i>Council Members</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,'council-roles') }}" href="{{ apa('post/council-roles') }}"><i class="fas fa-users"></i>Council Roles</a>
									</li>

								</ul>
							</div>
						</li>

					<li class="nav-item">
						<a class="nav-link {{ get_admin_menu_active_class($currentURI,['charter-pledge-popup', 'charter-pledge-banner', 'pledge-list', 'pledge-registrations']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#charter_controls" aria-controls="submenu-1-1"><i class=" fas fa-lock"></i>Manage Charter Pledge</a>
						<div id="charter_controls" class="collapse submenu" style="">
							<ul class="nav flex-column">
								<li class="nav-item">
									<a class="nav-link {{ get_admin_menu_active_class($currentURI,'charter-pledge-banner') }}" href="{{ apa('post/charter-pledge-banner') }}"><i class="fas fa-users"></i>Banner</a>
								</li>
								<li class="nav-item">
									<a class="nav-link {{ get_admin_menu_active_class($currentURI,'charter-pledge-popup') }}" href="{{ apa('post/charter-pledge-popup') }}"><i class="fas fa-users"></i>Popup</a>
								</li>
								<li class="nav-item">
									<a class="nav-link {{ get_admin_menu_active_class($currentURI,'pledge-list') }}" href="{{ apa('post/pledge-list') }}"><i class="fas fa-users"></i>Pledge List</a>
								</li>
								<li class="nav-item">
									{{-- <a class="nav-link {{ get_admin_menu_active_class($currentURI,'council-members') }}" href="{{ apa('post/council-members') }}"><i class="fas fa-users"></i>Registrations</a> --}}
									<a class="nav-link {{ get_admin_menu_active_class($currentURI,'pledge-registrations') }}" href="{{apa('registrations/charter-pledge-registrations')}}"><i class="fas fa-users"></i>Registrations</a>
								</li>
							</ul>
						</div>
					</li>

					<li class="nav-item">
						<a class="nav-link {{ get_admin_menu_active_class($currentURI,['elderly-people', 'elderly-people-banner']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#elderly_people_controls" aria-controls="submenu-1-1"><i class=" fas fa-lock"></i>Manage Elderly People</a>
						<div id="elderly_people_controls" class="collapse submenu" style="">
							<ul class="nav flex-column">
								<li class="nav-item">
									<a class="nav-link {{ get_admin_menu_active_class($currentURI,'elderly-people-banner') }}" href="{{ apa('post/elderly-people-banner') }}"><i class="fas fa-users"></i>Banner</a>
								</li>
								<li class="nav-item">
									<a class="nav-link {{ get_admin_menu_active_class($currentURI,'elderly-people') }}" href="{{ apa('post/elderly-people') }}"><i class="fas fa-users"></i>List of Videos</a>
								</li>
							</ul>
						</div>
					</li>

					@if( Auth::user()->hasRole('Super Admin'))
						<li class="nav-item">
							<a class="nav-link {{ get_admin_menu_active_class($currentURI,['permissions','roles','users']) }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#access_controls" aria-controls="submenu-1-1"><i class=" fas fa-lock"></i>Access Control</a>
							<div id="access_controls" class="collapse submenu" style="">
								<ul class="nav flex-column">
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,'users') }}" href="{{ apa('users') }}"><i class="fas fa-users"></i>Users</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['setting']) }}" href="{{ apa('setting') }}"><i class="fas fa-street-view"></i>Website Settings</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['permissions']) }}" href="{{ apa('permissions') }}"><i class="fas fa-puzzle-piece"></i>Manage Permissions</a>
									</li>
									<li class="nav-item">
										<a class="nav-link {{ get_admin_menu_active_class($currentURI,['roles']) }}" href="{{ apa('roles') }}"><i class="fas fa-street-view"></i>Manage Roles</a>
									</li>
								</ul>
							</div>
						</li>

						<!-- Menu Template below  -->
						<li class="nav-item">
							<a class="nav-link {{ get_admin_menu_active_class($currentURI,['audit_logs']) }}" href="{{ route('admin_audit_logs') }}"><i class="fas fa-key"></i>Audit Logs</a>
						</li>
					@endif
                </ul>
            </div>
        </nav>
    </div>
</div>