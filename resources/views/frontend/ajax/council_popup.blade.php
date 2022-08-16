<div class="popup popup-small no-padding council_pop" style="display:inline-block;">
   <div class="popup-inner">   
       <div class="popup-content" >
         <div class="pop_lft">
            <div class="pop_lft_img">
              <div class="img_" style="background-image: url('{{PP($council->getData('council_image'))}}');"></div>
            </div>
         </div>
         <div class="pop_rgt">
           <div class="details_box">
                <div class="pop_rgt_hd">
                  <div class="title_">{{$council->getData('post_title')}}</div>
                  <div class="sub_tit">{{$council->getData('subtitle')}}</div>
                  <?php
                    $role = ($lang == "en") ? $council->getCouncilRoleEN() : $council->getCouncilRoleAR(); 
                  ?>
                  <span>{{$role}}</span>
                </div>
                <div class="text_box">
                  {!! $council->getData('description') !!}
                </div>
           </div>
         </div>
       </div>
    </div>
</div>