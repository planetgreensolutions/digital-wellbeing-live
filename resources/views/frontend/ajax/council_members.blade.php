@if(!empty($council_members))
@foreach($council_members as $item)
<div class="tip_item">
  <div class="inner_ ">
    <div class="top_box">
      @if(!empty($item->getData('description')))
      <a class="full_link" href="#" data-src="{{route('council-member', [$lang, 'member_id' => $item->post_id])}}" data-type="ajax" data-fancybox=""></a>
      @endif
      <div class="shape_ fill_lightblue">
        <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
          preserveAspectRatio="none">
          <polygon points="30,30 0,30 0,0 27.447,4.787 " />
        </svg>
      </div>
      <div class="img_box">
        <div class="img_ b-lazy" data-src="{{PP($item->getData('council_image'))}}"></div>
        <div class="meta_tag color-lightblue">
          <ul>
            <?php
              $role = ($lang == "en") ? $item->getCouncilRoleEN() : $item->getCouncilRoleAR(); 
            ?>
            <li>{{$role}}</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="details_box">
      <div class="title_">{{$item->getData('post_title')}}</div>

      <div class="text_box">
        <p>{{$item->getData('subtitle')}}</p>
      </div>

      <div class="more-wrap ">
        <a class="full_link"></a>
        @if(!empty($item->getData('description')))
        <a class="more_dote_ btn_lightblue" href="#" data-src="{{route('council-member', [$lang, 'member_id' => $item->post_id])}}" data-type="ajax" data-fancybox="">
          <span></span>
          <span></span>
          <span></span>
        </a>
        @endif
      </div>
    </div>

  </div>
</div>
@endforeach
@endif