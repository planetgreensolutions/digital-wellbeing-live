@if(!empty($guides) && $guides->isNotEmpty())
    @foreach($guides as $item)
        @php
            $guideImage=getFrontendAsset('images/default_tips_image.jpg');
            if($item->getData('young_people_guides_image')){
            $guideImage=PP($item->getData('young_people_guides_image'));
            }
        @endphp
        <div class="item_">
            <div class="img_box">
                <div class="img_ b-lazy" data-src="{{$guideImage}}"></div>
                @if(!empty($item->getData('young_people_guides_pdf')))
                <a data-fancybox data-type="iframe" href="{{PP($item->getData('young_people_guides_pdf')) }}">
                <div class="dwnload_">
                <div class="icon_">
                    <img src="{{getFrontendAsset('images/download-icon.svg') }}" />
                </div>
                <div class="text_">{{lang('download')}}</div>
                </div>
                </a>
                @endif
                
                </div>
                <div class="name_">{{$item->getData('post_title')}}</div>
        </div>
       
    @endforeach
@endif