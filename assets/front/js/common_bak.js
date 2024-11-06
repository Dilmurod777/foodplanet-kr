/*document.write("<script src='../assets/front/js/mo_detect.js'></script>");
$(function(){
	var md = new MobileDetect(window.navigator.userAgent);
	if(md.mobile()) {
		$(".wrap").addClass("mobile");
	}else {
		$(".wrap").addClass("pc");
	}
});
var vh = window.innerHeight * 0.01
document.documentElement.style.setProperty('--vh', `${vh}px`)
window.addEventListener('resize', () => {
  var vh = window.innerHeight * 0.01
  document.documentElement.style.setProperty('--vh', `${vh}px`)
	  //console.log(--vh);
});
*/
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
	$(".dim").each(function(){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			closepop(this);
			if($(".filter").length){
				$(".filter").removeClass("active");
			};
		});
	});
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
	$(".btn-join").each(function(e){
		$(this).off("click").on("click" , function(e){
			e.preventDefault();
			if($(this).hasClass("btn-find")){
				$("html").addClass("over");
			}else{
				$("html").addClass("open-login");
			};
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
			//$(this).siblings(".btn-reset").show();
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
		if(ww<= 720){
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
		  if (ww <= 720 && mySwiper == undefined) {
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
		  } else if (ww > 720 && mySwiper != undefined) {
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
				if(ww <= 720){
					var hh = $(".header").height() + $(".tabs").height();
				}else{
					var hh = $(".header").height() + $(".tabs").height();
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





		//탭-컨텐츠 스크롤 연결
		var didScroll;
		var lastScroll = 0;
		var lastScrollLeft = 0;
		// 스크롤시에 사용자가 스크롤했다는 것을 알림 
		$(window).scroll(function(event){
			didScroll = true;
			var crtScroll = $(this).scrollTop();
			 lastScroll = crtScroll;
			 var sbnScrollLeft = $(".tabs .swiper-wrapper").scrollLeft();
			 if (lastScrollLeft != sbnScrollLeft) {
				console.log('scroll x');
				lastScrollLeft = sbnScrollLeft;
			 }
		});
		// hasScrolled()를 실행하고 didScroll 상태를 재설정
		setInterval(function() {
			if (didScroll) {
			   golaScroll();
			   didScroll = false;
			}
		}, 300);
		//수직스크롤시 썸네일 수평스크롤 및 on클래스
		function golaScroll(){
			var sections = $(".tab-cont .cont-box");
			var nav = $(".tabs.scroller");
			var nav_height = nav.outerHeight();
			var cur_pos = $(this).scrollTop();
			var hh = $(".header").height() + nav_height;
			var ww = $(window).width();
			if(ww <= 720){
				var pdb = 60
			}else{
				var pdb = 80
			};
			sections.each(function() {
				var tops = $(this).offset().top - hh*2,
					bottoms = tops + $(this).outerHeight() ;
				if (cur_pos >= tops && cur_pos <= bottoms) {
					var currentid = $('a[href="#' + $(this).attr('id') + '"]');
						nav.find(currentid).parent().siblings(".swiper-slide").removeClass("on");
						nav.find(currentid).parent().addClass("on");
					//var currentTab = $(".tabs li.swiper-slide").index($("li.on"));
					//nav.find(".swiper-slide.on").removeClass("on");
					//nav.find(currentTab).parent().addClass("on");
					//$(this).siblings(".cont-box").removeClass("active");
					//$(this).addClass("active");
					var target = nav.find(currentid).parent();
					muCenter(target);
				}
			});
		}







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
		if(ww<= 720){
			$(".tb-list-cont .btn-tb-list").each(function(e){
				$(this).off("click").on("click" , function(e){
					e.preventDefault();
					$(this).toggleClass("on");
					$(this).next("dd").slideToggle(300);
				});
			});
		};	
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
		$(window).scroll(function() {
			var scrollTop = $(window).scrollTop();
			if(scrollTop > 80){
				$(".sticky-box").addClass("onscroll");
				if(scrollTop >=104){
					$(".sticky-box").addClass("onscroll2");
				};
			}else{
				$(".sticky-box").removeClass("onscroll");
			};
		}).scroll();
	};
	/*
	$(".common-nav .btn-nav").off("click").on("click" , function(e){
		//e.preventDefault();
		if(!$(".main").length && !$(".secret-wrap").length){
			console.log("메인아님")
			if($(".safe-wrap").length){
				if($(".safe-intro").hasClass("hide")){
					$("html").removeClass("ready");
				};
			}else{
				$("html").removeClass("ready");
			};
		};
		$(".common-nav").removeClass("active");
		$(".main-nav").removeClass("locked active");
	});
	*/
	//메인 nav
	/*$(window).bind('wheel', function(event){
		if (event.originalEvent.wheelDelta > 0 || event.originalEvent.detail < 0) {
			//scroll up
			$(".main-nav").removeClass("active");
		}else{
			//scroll down
			$(".main-nav").addClass("active");
		}
	});
	$(window).on("touchstart", function(e) {
		var startingY = e.originalEvent.touches[0].pageY;
		$(window).on("touchmove", function(e) {
			currentY = e.originalEvent.touches[0].pageY;
			var delta = currentY - startingY;
			if(delta >0 || startingY < 0){
				$(".main-nav").removeClass("active");
			}else{
				$(".main-nav").addClass("active");
			}
		});
	});*/
	$(window).on('wheel', function(e) {
		if($('.main-nav').hasClass('active') && e.originalEvent.wheelDelta > 0) {
			$('.main-nav').removeClass('active');
		}

		if(!$('.main-nav').hasClass('active') && e.originalEvent.wheelDelta < 0) {
			$('.main-nav').addClass('active');
		}
	});

	let clientY = 0;
	$(window).on('touchstart touchmove touchend', function(e) {
		switch(e.type) {
			case 'touchstart' :
				clientY = e.touches[0].clientY;
				break;
			case 'touchmove' :
			case 'touchend' :
				let deltaY = e.changedTouches[0].clientY - clientY;

				if($('.main-nav').hasClass('active') && deltaY > 0) {
					$('.main-nav').removeClass('active');
				}

				if(!$('.main-nav').hasClass('active') && deltaY < 0) {
					$('.main-nav').addClass('active');
				}
				break;
		}
	});

	if($(".ready").length){
		window.onbeforeunload = function () {
			window.scrollTo(0, 0);
		};
	};
	//사전예약
	if($(".res-wrap").length){
		window.onbeforeunload = function () {
			window.scrollTo(0, 0);
		};
		setTimeout( function () {
			$("html").removeClass("ready");
			$(".res-wrap").addClass("up");
		}, 2500);
		//필수동의
		$(".res-page.page2 .btn-submit").click(function(){
			//agreeChk(this);
			//fn_openpop();
			openpop(this);
		});
		function agreeChk(obj){
			var THIS = obj;
			var objLength = $("input:radio.agreeRes1").length;
			if($("input:radio.agreeRes1:checked").length < objLength){
				alert("동의하지 않을 경우 파티 알림을 받으실 수 없습니다.");
				}else{
					$(".alarm-apply .ip-tel").each(function(index, item){
					// 아무값없이 띄어쓰기만 있을 때도 빈 값으로 체크되도록 trim() 함수 호출
					if($(this).val().trim() == '') {
					   alert("휴대폰번호를 입력해주세요.");
					   return false;
					}else{
						fn_openpop();
					};
				});
			}
		};
		function fn_openpop(){
			$("html").addClass("is-opened");
			$(".layer-alarm").addClass("is-opened");
		};
		//필수동의 자세히보기
		//$(".agree-list .btn-moreinfo").on("click", function(){
		//	$(this).next("div").toggleClass("active");
		//});
	};
	if($(".icon-scroll").length){
		$(window).scroll(function(){
			var $scroll = $(window).scrollTop();
			if($scroll > 50){
				$("html").addClass("scrolled");
				$(".icon-scroll").fadeOut(700);
			}else{
				$("html").removeClass("scrolled");
				$(".icon-scroll").fadeIn(700);
			};
		});
		//스크롤
		//$(".icon-scroll").click(function(){
		//	$("html, body").animate({scrollTop : ($(".footer").offset().top)}, 600);
		//});
	};
	//스크롤감지
	if($(".detect-scroll").length){
		$(window).scroll(function() {
		   if($(window).scrollTop() + window.innerHeight >= $(document).height() - 1) {
			   if($(".mis-list").outerHeight()>1){
					alert("bottom!");
			   };
		   }
		});
	};
	//프로필이미지 선택
	$(".chk-profile li").click(function(){
		var $index = $(this).index() + 1;
		$(".chk-profile li").removeClass("active");
		$(this).addClass("active");
		$(this).closest(".profile").find(".profile-img img").attr("src","../assets/front/images/profile"+$index+".png");
	});
	//파티룸배경 선택
	$(".chk-room li").click(function(){
		var $index = $(this).index()+1;
		$(".chk-room li").removeClass("active");
		$(this).addClass("active");
		$(this).closest(".room-wrap").find(".wall img").attr("src","../assets/front/images/dress_wall"+$index+".png");
	});
	//티켓부스gate모션
	if($(".booth-gate").length){
		//$("html").addClass("gate");
		//$(".booth-wrap").hide();
		$(".booth-wrap").addClass("appear");
		setTimeout( function () {
			$("html").addClass("showtime");
			$(".booth-wrap").show();
			setTimeout( function () {
				$(".booth-gate").hide();
			}, 1000);
		}, 2000);
	};
});
