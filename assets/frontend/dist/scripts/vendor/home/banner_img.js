//*** SHIM ***
window.requestAnimFrame = (function() {
    return window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame ||
        window.oRequestAnimationFrame ||
        window.msRequestAnimationFrame ||
        function(callback) {
            window.setTimeout(callback, 1000 / 60);

        };
})();

(function() {
    "use strict";

    //************
    //VARIABLES
    //************
    var _Canvas;
    let _main_img = document.getElementsByClassName("banner_img")[0];
    let _frontImageSrc = _main_img.src; // black add
    let _backImageSrc = _main_img.src;
    let _frontImage;
    let _backImage;
    let _blackMask;

    let _frameWidth = _main_img.width;
    let _frameHeight = _main_img.height;


    let _mouseX = _frameWidth / 2;
    let _mouseY = _frameHeight / 3;
    let _maskCount = 25;
    let _tweenTime = 0.5;
    let _pauseTime = 0.25;
    let _delayTime = 0.15;
    let _maskArray = [];
    let _srcArray = [_main_img.getAttribute('data-mask1'),_main_img.getAttribute('data-mask2'),_main_img.getAttribute('data-mask3')];
    //console.log(_main_img.getAttribute('data-mask1'),_main_img.getAttribute('data-mask2'),_main_img.getAttribute('data-mask3'));
    let _temp_count = 0;
    let _animaton_done = false;

    //************
    //METHODS
    //************
    function init() {
        _Canvas = new Canvas({
            stage: document.getElementById('stage')
        });
        _backImage = new MaskedImage({
            src: _backImageSrc
        });
        _frontImage = new MaskedImage({
            src: _frontImageSrc
        });
        var width_start = 500;
        for (let i = 0; i < _maskCount; i++) {
            let ranSrc = _srcArray[Math.floor(Math.random() * _srcArray.length)];
            let mask = new MaskedImage({
                src: ranSrc,
                delay: i,
                width: width_start
            });
            _maskArray.push(mask);


        }
        addListeners();
    }

    //************
    //EVENTS
    //************
    const app = (min, max) => {
        return Math.random() * (max - min) + min;
    }

    function addListeners() {
        //_Canvas.el.addEventListener('mousemove', onCanvasMouseMove);
        _Canvas.el.addEventListener('mouseout', onCanvasMouseOut);
    }

    function onCanvasMouseMove(event) {
        _mouseX = event.pageX - $(this).offset().left;
        _mouseY = event.pageY - $(this).offset().top;
    }

    function onCanvasMouseOut(event) {
        // _mouseX = _frameWidth / 2;
        // _mouseY = _frameHeight / 3;
        setInterval(function() {
            random_move();
        }, 100);

    }

    function random_move() {
        _mouseX = app(((_frameWidth / 2) - 100), ((_frameWidth / 2) + 100));
        _mouseY = app(((_frameHeight / 3) - 100), ((_frameHeight / 3) + 100));
    }

    function onEnterFrame() {
        //console.log(_frameWidth,_temp_count++); 
        if (document.body.classList.contains('is-loaded') && !_animaton_done) {
          //  console.log("draw");
            _Canvas.clearStage();
            drawStage();
            //console.log(_animaton_done,'akhil');
        }

        window.requestAnimFrame(onEnterFrame, 120);



    }

    function drawStage() {
        _Canvas.context.save();

        for (let i = 0; i < _maskCount; i++) {
            let mask = _maskArray[i];
            mask.tweenDraw();

        }
        //_blackMask.draw(_mouseX,_mouseY);
        _Canvas.context.globalCompositeOperation = 'source-in';
        _backImage.draw(0, 0, 1);
        _Canvas.context.restore();
    }


    //************
    //CLASSES
    //************

    class MaskedImage {
        constructor(options) {
            this.hasImg = false;
            this.img = new Image();
            this.empty = {
                scale: 0,
                alpha: 1,
                x: 0,
                y: 0
            };
            this.delay = options.delay;
            this.rotation = Math.random() * 360;
            this.width = options.width / 2;
            this.halfWidth = (this.width / 2) / 2;
            this.img.src = options.src;
            this.img.onload = function() {


                this.hasImg = true;

                if (this.delay && !_animaton_done) {

                    setTimeout(function() {
                        this.scale();
                    }.bind(this), this.delay * (_delayTime * 1000));

                }
                this.draw();

            }.bind(this);
        }

        draw(x = 0, y = 0, flag = 0) {

            if (flag) {
                //console.log(this.img.src,this.hasImg,_frameWidth);
                _Canvas.context.drawImage(this.img, x, y, _frameWidth, _frameHeight);
            } else if (this.hasImg) {
                _Canvas.context.drawImage(this.img, x, y);

            }
        }

        tweenDraw() {
            if (this.hasImg) {

                let curWidth = this.width * this.empty.scale;
                _Canvas.context.save();
                _Canvas.context.globalAlpha = this.empty.alpha;

                _Canvas.context.translate(this.empty.x, this.empty.y);
                _Canvas.context.rotate(this.rotation * Math.PI / 180);
                _Canvas.context.scale(1.5 * (curWidth / this.width), 1.5 * (curWidth / this.width));
                _Canvas.context.translate(-this.empty.x, -this.empty.y);
                _Canvas.context.drawImage(this.img, this.empty.x - this.halfWidth, this.empty.y - this.halfWidth);
                _Canvas.context.globalAlpha = 1;
                _Canvas.context.restore();

            }
        }

        scale() {
            this.empty.x = _mouseX;
            this.empty.y = _mouseY;
            this.rotation = Math.random() * 360;


            if (_temp_count < 20) {
                if (_temp_count >= 15 && _temp_count <= 20)
                    _pauseTime = _pauseTime * 5;

                TweenMax.fromTo(this.empty, _tweenTime, {
                    alpha: 1,
                    scale: 0
                }, {
                    alpha: 1,
                    scale: 1,
                    onComplete: function() {
                        setTimeout(this.fadeOut.bind(this), _pauseTime * 1000);
                    }.bind(this)
                });

                _temp_count++;
                //console.log(_temp_count,_tweenTime);  
            } else if(!_animaton_done) { // if(!_animaton_done)
                //console.log(_temp_count, 'out');
                _temp_count++;

                //_tweenTime=_tweenTime * 3;
                _tweenTime = _tweenTime + 2;
                TweenMax.fromTo(this.empty, _tweenTime, {
                    alpha: 1,
                    scale: 0
                }, {
                    alpha: 1,
                    scale: 10,
                    onComplete: function() {
                        //TweenMax.fromTo(this.empty, _tweenTime , {alpha:0, scale:0},{alpha:1, scale:10, onComplete:function(){
                       // console.log("done");

                        //	_Canvas.context.globalCompositeOperation = 'source-in';
                        //_backImage.draw(0,0,1);

                        this.img = new Image();
                        this.img.src = _backImageSrc;
                        _Canvas.context.globalCompositeOperation = 'destination-over';
                        //_frontImage.draw(0,0,1); 
                        //_Canvas.context.scale(.5 , .5 );
                        _Canvas.context.globalAlpha = .3;
                        _Canvas.context.drawImage(this.img, 0, 0, _frameWidth, _frameHeight);
                        //_Canvas.context.globalAlpha = 1;
                        _Canvas.context.restore();

                        TweenMax.fromTo(this.img, 2, {
                            alpha: 0
                        }, {
                            alpha: 1,
                            onComplete: function() {
                                //console.log('in done');
                            }.bind(this)
                        });

                        _animaton_done = true;


                    }.bind(this)
                });
            }



        }

        fadeOut() {

            TweenMax.to(this.empty, _tweenTime, {
                alpha: 0,
                onComplete: this.scale.bind(this)
            });
        }

    }

    class Canvas {
        constructor(options) {
            this._stage = options.stage;
            this._stageWidth = this._stage.width = _frameWidth;
            this._stageHeight = this._stage.height = _frameHeight;
            this._stageContext = this._stage.getContext('2d');

        }

        // clear stage of current content
        clearStage(options) {
            if (typeof options === "undefined") {
                this._stageContext.clearRect(0, 0, this._stageWidth, this._stageHeight);
            }
        }

        get width() {
            return this._stageWidth;
        }
        get height() {
            return this._stageHeight;
        }
        get el() {
            return this._stage;
        }
        get context() {
            return this._stageContext;
        }
    } //end Canvas class

    //var main_img = document.getElementsByClassName("banner_img")[0];
    //console.log('in-check',main_img.complete); 

    if (_main_img.complete) {
        init();
        onEnterFrame();

    }




})();