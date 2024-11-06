//navigation
//팝업 공통 열기
function openpop(obj){
	var pops = $(obj).attr("data-link");
	var $top = $(obj).offset().top;
	var $scroll = $(window).scrollTop();
	$(pops).addClass("is-opened");
	$("html").addClass("is-opened");
	if($(pops).hasClass("layer-tip")){
		$(pops).css("top",$top - $scroll);
	};
	if($(pops).hasClass("layer-over")){
		$("html").addClass("over");
	};
	if($(obj).hasClass("btn-over")){
		$("html").addClass("over");
		$(pops).addClass("layer-over");
	};
	if($(obj).hasClass("btn-over2")){
		$("html").addClass("over2");
		$(pops).addClass("layer-over2");
	};
	if($(obj).hasClass("btn-ticket")){
		$(".icon-scroll").show();
		$(".layer-ticket .layer-inner").scroll(function () {
			var crrTop = $(".layer-ticket .layer-inner").scrollTop();
			if(crrTop > 50){
				$(".icon-scroll").fadeOut(700);
			}else{
				$(".icon-scroll").fadeIn(700);
			};
		});
	};
};
//팝업 공통닫기
function closepop(obj){
	var pops = $(obj).closest(".layerpop");
	$(pops).removeClass("is-opened");
	if($(pops).hasClass("layer-search")){
		$("html").removeClass("is-opened nav-opened");
		$(".nav-dim").removeClass("nav-dim");
	}else if($(pops).hasClass("layer-over")){
		$("html").removeClass("over");
		//$(pops).removeClass("layer-over");
		if($(pops).hasClass("layer-emailsent")){
			$("html").removeClass("is-opened");
		};
	}else if($(pops).hasClass("layer-over2")){
		$("html").removeClass("over2");
		//$(pops).removeClass("layer-over2");
	}else{
		$("html").removeClass("is-opened");
	};
};
//비밀번호찾기(찾기)
function findpass(obj){
	var pops = $(obj).attr("data-link");
	$(pops).addClass("is-opened");
	$("html").addClass("is-opened over");
};
//radio chekck
function getNumber(obj){
	if($("input:checkbox[name=misAgree1]").is(':checked')){
		// $(obj).closest("li").find(".ip-phone").show();
		$(".agree2").show();
	}else{
		// $(obj).closest("li").find(".ip-phone").hide();
		$(".agree2").hide();
	}
};
$(function(){
	var $scroll = $(window).scrollTop();
	if($scroll > 50){
		$("html").addClass("scrolled");
	};
	$(window).scroll(function(){
		var $scroll = $(window).scrollTop();
		var $scrollLeft = -this.scrollX    
		$(".scroll-x").css({left:$scrollLeft}) 
		if($scroll > 50){
			$("html").addClass("scrolled");
		}else{
			$("html").removeClass("scrolled");
		};
	});
	//팝업 열기 버튼 공통
	$(".btn-layer").each(function(e){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			openpop(this);
		});
	});
	//팝업 닫기 버튼 공통
	$(".layer-close").each(function(){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			closepop(this);		
		});
	});
	//dim 클릭시 팝업 닫기
/*	$(".dim").each(function(){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			closepop(this);
			if($(".filter").length){
				$(".filter").removeClass("active");
			};
		});
	}); */
	//nav
	$(".header .btn-nav").off("click").on("click" , function(e){
		e.preventDefault();
		$("html").addClass("is-opened nav-opened");
		$("#gnb").addClass("is-active");
		$(".dim").addClass("nav-dim");
	});
	$(".nav-dim, .header .gnb-close").each(function(){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			$("html").removeClass("is-opened  nav-opened");
			$("#gnb").removeClass("is-active");
			$(".nav-dim").removeClass("nav-dim");
		});
	});
	var ww = $(window).width();
	if(ww <= 900){
		$(".depth1").children("a").each(function(){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$(this).next(".depth2").stop().slideToggle(500);
			});
		});
	}else{
		$(".depth1").each(function(){
			$(this).hover(
				function(){ 
					$(this).addClass("activate");
					$(this).closest(".header").addClass("depth");
				},
				function(){
					$(this).removeClass("activate");
					$(this).closest(".header").removeClass("depth");
				} 
			);
		});
	};
	//검색어 리셋
	$(".searchbox").each(function(){
		if($(this).find(".ip-search").val().length == 0){
			$(this).find(".btn-reset").hide();
		}else{
			$(this).find(".btn-reset").show();
		};
		$(this).find(".ip-search").on("keyup focus", function(){
			$(this).siblings(".btn-reset").show();
			if($(this).val().length == 0){
				$(this).siblings(".btn-reset").hide();
			}else{
				$(this).siblings(".btn-reset").show();
			}
		});
		/*$(this).find(".ip-search").on("blur", function(){
			$(this).siblings(".btn-reset").hide();
		});*/
		$(this).find(".btn-reset").on("click touchstart", function(){
			$(this).closest(".searchbox").find(".ip-search").val('');
			$(this).closest(".searchbox").find(".btn-reset").hide();
			return false;
		});
	});
	//로그인/비밀번호찾기 버튼
	$(".btn-login").each(function(e){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			if($(this).hasClass("btn-find")){
				$("html").addClass("over");
			}else{
				$("html").addClass("open-login");
			};
			$('.gnb-close').click();
		});
	});
	$(".btn-close-login").each(function(e){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			if($(this).hasClass("btn-close-find")){
				$("html").removeClass("over");
			}else{
				$("html").removeClass("open-login is-opened");
			};
		});
	});
	//파일첨부custom
	$(".custom-file").on("change",function(){
		var fileName = $(this).val();
		$(this).siblings(".upload-title").val(fileName);
		if(fileName.length>0){
			$(this).parent(".filebox").addClass("on");
		};
	});
	$(".filebox .btn-reset").each(function(e){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			$(this).siblings(".upload-title").val("");
			$(this).parent(".filebox").removeClass("on");
		});
	});
	//filter
	if($(".filter").length){
		var ww = $(window).width();
		$(".filter dt").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$(this).toggleClass("active");
				$(this).next("dd").slideToggle(300);
			});
		});
		$(".btn-filter").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$(this).next(".filter").addClass("active");
				$("html").addClass("is-opened");
			});
		});
		if(ww<= 900){
			$(".list-cont .btn-list").each(function(e){
				$(this).off("click").on("click" , function(e){
					e.preventDefault();
					$(this).toggleClass("on");
					$(this).next("dd").slideToggle(300);
				});
			});
		};
		//필터항목 더보기
		$(".filter .btn-more").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$(this).parent("dd").addClass("showAll");
			});
		});
		//필터선택완료
		$(".filter .btn-submit").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$(this).closest(".filter").removeClass("active");
				$("html").removeClass("is-opened");
			});
		});
		///필터 리셋
		$(".filter-reset").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$(".filter dt").removeClass("active");
				$(".filter dd").hide();
				$(".filter input[type=checkbox]").prop("checked", false);
			});
		});
	};
	//관심기업
/*	$(".btn-like").each(function(e){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			if($(this).hasClass("on")){
				$(this).removeClass("on");
				$(".dim").fadeIn();
				$(".favorite-out").fadeIn();
				setTimeout(function() {
					$(".dim").fadeOut();
					$(".favorite-out").fadeOut();
				}, 3000);
			}else{
				$(this).addClass("on");
				$(".dim").fadeIn();
				$(".favorite-in").fadeIn();
				setTimeout(function() {
					$(".dim").fadeOut();
					$(".favorite-in").fadeOut();
				}, 3000);
			};
		});
	}); */
	//반응형 탭
	if($(".tab-area").length){
		if($(".tabs.scroller").length){
			var tabTop = $(".tabs").offset().top;
			var hh = $(".header").height();
			var tops = tabTop - hh;
			$(window).scroll(function() {
				var scrollTop = $(window).scrollTop();
				if(scrollTop > 100){
					if(scrollTop > tops){
						$(".tab-area").addClass("fixed");
						$(".tab-area .tabs").css("top",hh+"px");
					}else{
						$(".tab-area").removeClass("fixed");
						$(".tab-area .tabs").css("top",0);
					};
				};
			}).scroll();
		};
		var ww = $(window).width();
		var mySwiper = undefined;
		function initSwiper() {
		  if (ww <= 900 && mySwiper == undefined) {
			mySwiper = new Swiper(".tabs", {
				observer: true,
				observeParents: true,
				preventClicks: true,
				preventClicksPropagation: false,
				slidesPerView: "auto",
				spaceBetween:0,
				freeMode: {
					enabled: false,
					sticky: false,
					momentumBounce: false
				}
			});
		  } else if (ww > 900 && mySwiper != undefined) {
			mySwiper.destroy();
			mySwiper = undefined;
		  }
		};

		initSwiper();

		$(window).on('resize', function () {
		  ww = $(window).width();
		  initSwiper();
		});
		// 클릭요소 중앙정렬
		function muCenter(target){
			var snbwrap = $(".tabs-wrapper");
			var targetPos = target.position();
			var boxWidth = $(".tabs").width();
			var bHeight = $(".tab-area").height() + 4;
			var wrapWidths=0;
			var wrapWidth=0;
			snbwrap.find(".swiper-slide").each(function(){
				wrapWidths += $(this).outerWidth();
			});
			var wrapWidth = wrapWidths ;
			var selectTargetPos = targetPos.left + target.outerWidth()/2;
			var pos;
			if(selectTargetPos <= boxWidth/2){
				pos = 0
				//$(".gradi-left").addClass("gradi-hide");
			}else if(wrapWidth - selectTargetPos <= boxWidth/2){
				pos = wrapWidth-boxWidth;
				//$(".gradi-left").removeClass("gradi-hide");
				//$(".gradi-right").addClass("gradi-hide");
			}else{
				pos = targetPos.left - (boxWidth/2) + (target.outerWidth()/2);
				//$(".gradi-left").removeClass("gradi-hide");
				//$(".gradi-right").removeClass("gradi-hide");
			}
			if(wrapWidth > boxWidth) {
				setTimeout(function(){snbwrap.css({
					"transform": "translate3d("+ (pos*-1) +"px, 0, 0)",
					"transition-duration": "300ms"
				})}, 200);
			}
		};
		//썸네일 클릭시 스크롤
		var bHeight = $(".tab-area").height() + 4;
		var $lankTitle = $(".tabs .swiper-slide a");
		$lankTitle.click(function(e){
			var target = $(this).parent();
			var idx = target.index();
			$lankTitle.parent().removeClass("on")
			target.addClass("on");
			muCenter(target);
			if($(this).closest(".tabs").hasClass("scroller")){
				var ww = $(window).width();
				var pdt = parseInt($(".tab-container").css('padding-top'));
				if(ww <= 900){
					var hh = $(".header").height() + $(".tabs").height() ;
				}else{
					var hh = $(".header").height() + $(".tabs").height() - pdt;
				};
				$("html, body").animate({
					scrollTop: $(".tab-area .tab-cont .cont-box").eq(idx).offset().top - hh
				}, 500);
			}else{
				$(".tab-area .tab-cont").removeClass("on");
				$(".tab-area .tab-cont").eq(idx).addClass("on");
			};
			return false;
		});
	};
	//토글버튼
	if($(".btn-toggle").length){
		$(".btn-toggle").off("click").on("click" , function(e){
			$(this).toggleClass("on");
		});
	};
	//국내데이터 상세 인증서 탭
	if($(".cer-cont-box").length){
		$(".cer-cont-box .btn-more").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$(this).parent(".cer-cont-box").addClass("showAll");
			});
		});
	};
	//해외데이터 국가상세 수입금지 탭
	if($(".btn-tb-list").length){
		var ww = $(window).width();
		if(ww<= 900){
			$(".tb-list-cont .btn-tb-list").each(function(e){
				$(this).off("click").on("click" , function(e){
					e.preventDefault();
					$(this).toggleClass("on");
					$(this).next("dd").slideToggle(300);
				});
			});
		};	
	};
	//해외데이터 국가상세 주요품목요건 탭
	if($(".ovf-box").length){
		$(".ovf-box").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$(this).toggleClass("on");
			});
		});
	};
	if($(".btn-more-box").length){
		$(".btn-more-box .btn-type5").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$(this).closest(".cont-box").addClass("opened");
			});
		});
	};
	//pc레이어-mo페이지 버튼
	$(".btn-pc-layer").each(function(e){
		$(this).off("click").on("click" , function(e){
			var pops = $(this).attr("data-link");
			e.preventDefault();
			$("html").addClass("open-pc-layer");
			$(pops).addClass("is-opened");
		});
	});
	$(".btn-close-tpc").each(function(e){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			$(this).closest(".type-pc-layer").removeClass("is-opened");
			$("html").removeClass("open-pc-layer is-opened");
		});
	});
	$(".pc-dim").each(function(e){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			$("html").removeClass("open-pc-layer is-opened");
		});
	});
	//국가선택 필터
	if($(".filter-nat").length){
		$(".btn-chk-nat").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$(this).parents().siblings(".filter-nat").addClass("active");
				$("html").addClass("is-opened");
			});
		});
		//국가필터선택완료
		$(".filter-nat .btn-submit").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$(this).closest(".filter-nat").removeClass("active");
				$("html").removeClass("is-opened");
			});
		});
		//국가선택 리셋
		$(".nat-reset").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$(".filter-nat input[type=checkbox]").prop("checked", false);
			});
		});
	};
	//제품상세 floating
	if($(".sticky-box").length){
		var floatPosition = parseInt($(".sticky-box").css('top'));
		//var btnTop = $(".sticky-box .btn-area").offset().top;
		$(window).scroll(function() {
			var scrollTop = $(window).scrollTop();
			if(scrollTop > 80){
				$(".sticky-box").addClass("onscroll");
			}else{
				$(".sticky-box").removeClass("onscroll");
			};
			if(ww <= 900){
				i//f(scrollTop > btnTop + 66 ){
				if(scrollTop > 66 ){
					$(".sticky-box .btn-area").addClass("sticky");
				}else{
					$(".sticky-box .btn-area").removeClass("sticky");
				};
			};
		}).scroll();
	};
	//커뮤니티 글쓰기
	if($(".write-area .btn-cate").length){
		$(".write-area .btn-cate").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$("html").addClass("is-opened");
			});
		});
		//카테고리선택완료
		$(".wrt-cate-layer .btn-submit").each(function(e){
			$(this).off("click").on("click" , function(e){
				e.preventDefault();
				$("html").removeClass("is-opened");
			});
		});
	};
	//go to top
	if($(".quick-top").length){
		if($(this).scrollTop() >= 100) {
            $(".quick-top").fadeIn(500);
          }else{
            $(".quick-top").fadeOut("slow");
        }
		$(window).scroll(function(){
          if($(this).scrollTop() >= 100) {
            $(".quick-top").fadeIn(500);
          }else{
            $(".quick-top").fadeOut("slow");
          }
        });
        $(".quick-top").click(function() {
          e.preventDefault();
          $("html, body").animate({scrollTop: 0}, 200);
        });
	};
	//quick-banner
	if($(".quick-banner").length){
		var $trigger = $(".fp-search").offset().top;
		if($(this).scrollTop() >= $trigger) {
//            $(".quick-banner").fadeOut("slow");
          }else{
//            $(".quick-banner").fadeIn("fast");
        }
		$(window).scroll(function(){
          if($(this).scrollTop() >= $trigger) {
//            $(".quick-banner").fadeOut("slow");
          }else{
//            $(".quick-banner").fadeIn("fast");
          }
        });
	};
});
