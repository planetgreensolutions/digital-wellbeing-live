{{ HTML::style('assets/frontend/dist/styles/main.css') }} 
@if($lang=="ar")
	{{ HTML::style('assets/frontend/dist/styles/main-rtl.css') }} 

@endif
{{ HTML::style('assets/frontend/dist/styles/developer.css') }} 

 <style>
   .loader {
    position: fixed;
    bottom: 0px;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    z-index: 99999999;
    background: #e2e8e8;
    margin: auto;
    -webkit-transition: width .5s ease-in-out, height .5s ease-in-out, opacity .3s .5s ease-in-out, visibility .3s .5s ease-in-out;
    -o-transition: width .5s ease-in-out, height .5s ease-in-out, opacity .3s .5s ease-in-out, visibility .3s .5s ease-in-out;
    transition: width .5s ease-in-out, height .5s ease-in-out, opacity .3s .5s ease-in-out, visibility .3s .5s ease-in-out;
}

.loader .loader-block {
    -webkit-transition: all .4s .1s ease-in-out;
    -o-transition: all .4s .1s ease-in-out;
    transition: all .4s .1s ease-in-out;
	width: 350px;
    text-align: center;
    -webkit-transform: translateY(1em) scale(.5);
    -ms-transform: translateY(1em) scale(.5);
    transform: translateY(1em) scale(.5);
}
.loader .loader-img img {
    max-width: 100%;
}
.is-loaded .loader {
    opacity: 0;
    visibility: hidden;
    /*width: 66.5vw; 
        height: calc(100% - 120px);
        left: 7%;
        right: auto;
        bottom: -200px;*/
}

.is-loaded .loader .loader-block {
    opacity: 0;
    -webkit-transform: translateY(2em) scale(.5);
    -ms-transform: translateY(2em) scale(.5);
    transform: translateY(2em) scale(.5);
}

.loader .loader-img svg {
    max-width: 270px;
    height: auto;
    width: 220px;
}

.loader .loader-img {
    margin: 0;
}

.loader .loader-img .path_ {
    stroke-dasharray: 712;
    stroke-dashoffset: 712;
    -webkit-animation: loader_path 1s linear infinite alternate;
    animation: loader_path 1s linear infinite alternate
}

@-webkit-keyframes loader_path {
    75%,
    to {
        stroke-dashoffset: 0
    }
}

@keyframes loader_path {
    95%,
    to {
        stroke-dashoffset: 0
    }
}

@media only screen and (max-height: 650px) and (max-width: 1300px) and (min-height: 500px) and (min-width: 1024px) {
    .is-loaded .loader {
        /*width: 80%;        
            width: 66.5vw; 
            height: calc(100% - 120px);*/
    }
}

@media only screen and (min-width: 768px) and (max-width: 980px) {
    .is-loaded .loader {
        /*width: 80%;        
            height: calc(100% - 130px);*/
    }
}

@media only screen and (max-width: 767px) {
    .loader .loader-img svg {
        width: 150px;
    }
}
    </style>
<script>

</script>
