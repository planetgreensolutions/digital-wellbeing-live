 {{Form::open(array('url'=>asset($lang.'/login'),'name'=>'login','id'=>'login','role'=>'form','class'=>'formContainer form-v3 loginFormAjax') )}}
    <div class="block_">
        <div class="row">
		<div class="message_box"></div>
        <div class="form-group input-field full_">
            <input id="uname" name="uname" type="text" autocomplete="new-uname" class="myEmail" required>
            <label for="uname">البريد الإلكتروني</label>
        </div>
        <div class="form-group input-field full_">
            <input id="password" name="password" type="password" autocomplete="new-password" required>
            <label for="password">كلمة المرور</label>
        </div>
        </div>
        <div class=" submit_button_wrapper">
        <div class="capcha_row">
            <div class="recaptcha" id="contactCaptcha"></div>
        </div>
        <button class="more filled_" type="submit" name="login"><span>الدخول</span></button>
        </div>
        <div class="row">
        <div class="link_box input-field full_">
            <ul>
            <li><a href="{{ asset($lang.'/forgot-password') }}" class="link_">نسيت كلمة المرور؟</a></li>
            <li>ليس لديك حساب؟ <a href="{{ asset($lang.'/register') }}" class="link_ color_">سجّل</a></li>
            </ul>
        </div>
        </div>
    </div>
    @include('frontend.common.form_loader')
{{ Form::close() }}