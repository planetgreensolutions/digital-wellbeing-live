<div class="safety-form  fade-up">
    {{ Form::open(['url' => route('report', [$lang]), 'id' => 'campaign_submit', 'class' => 'campaign_submit  form-v3']) }}
    <div class="counter shape_ fill_blue">
        <svg x="0px" y="0px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve"
            preserveAspectRatio="none">
            <polygon points="30,30 0,30 0,0 27.447,4.787 "></polygon>
        </svg>
        <span>01</span>
    </div>

    <div id="safety_form">

        <h3> </h3>
        <section>

            <div class="input-field  check-input ">

                <div class="row form-inner">
                    <label>
                        <input class="with-gap error" value="Child" name="report_by" type="radio">
                        <span>I am a Child</span>
                    </label>

                    <label>
                        <input class="with-gap error" value="Behalf of the child" name="report_by" type="radio">
                        <span>I am reporting on behalf of the child </span>
                    </label>
                </div>

            </div>


        </section>

        @if (!empty($reportQuestios) && $reportQuestios->count() > 0)
            @foreach ($reportQuestios as $question)

                <h3> </h3>
                <section>
                    <p>{{ $question->getData('post_title') }}</p>
                    <div class="row form-inner number-box">

                        <?php

            for($i=1;$i<=5;$i++)
            {

                $report_question_option = $question->getData('report_question_option'.$i);
                if($report_question_option)
                {
                
                ?>

                        <label>
                            <input class="with-gap error" value="{{ $report_question_option }}"
                                name="report_data[{{ $question->getData('post_title') }}]" type="radio">
                            <span>{!! $report_question_option !!}</span>
                        </label>

                        <?php } } ?>

                    </div>
                </section>

            @endforeach
        @endif

        <h3> </h3>
        <section>
            <label>Try to tell us in as much detail what is going on *</label>
            <div class="row form-inner">

                <textarea id="report_message" name="report_message" required></textarea>
            </div>
        </section>

    </div>
    {{ Form::close() }}
</div>
