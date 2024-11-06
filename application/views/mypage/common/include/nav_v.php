<style>
.profile_img {position:relative;display:block;border-radius:100%;width:42px;height:42px;overflow:hidden;background:url(../../images/no-profile.png) 0 0 no-repeat;background-size:cover; margin:0 auto;}
.profile_img img {width:100% !important;height: 100% !important;-o-object-fit: cover;object-fit: cover;-o-object-position: center center;object-position: center center;}
</style>
<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element" style="text-align:center">
                        <div class="profile_img">
                        <?php 
                            if(empty($member['profile_img'])) {
                        ?>
                                <img alt="image" class="rounded-circle" src="/assets/front/images/icon_profile_bg2.png" style="max-width:45px;">
                        <?php  
                            }
                            else {
                        ?>
                                <img alt="image" class="rounded-circle" src="/api/common/img_view?img_path=<?php echo $member['profile_img']; ?>" style="max-width:45px;">
                        <?php
                            }
                        ?>
                        </div>
                        <span class="block m-t-xs font-bold" style="color:#fff"><?php echo $member['member_id']; ?></span>
                    </div>
					<div class="logo-element">
                        <img src="/assets/img/logo.png" style="max-width:90%">
                    </div>
                </li>
                <li class="<?php echo $menu === 'member' ? 'active' : ''; ?>">
                    <a href="/mypage/member"><i class="fa fa-address-card-o"></i> <span class="nav-label">계정기본정보 관리</span></a>
                </li>
                <li class="<?php echo $menu === 'wish' ? 'active' : ''; ?>">
                    <a href="/mypage/wish/list"><i class="fa fa-heart"></i> <span class="nav-label">관심기업/제품 관리</span></a>
                </li>
                <li class="<?php echo $menu === 'recommend' ? 'active' : ''; ?>">
                    <a href="/mypage/recommend"><i class="fa fa-handshake-o"></i> <span class="nav-label">새로운 멤버 초대</span></a>
                </li>
            </ul>

        </div>
    </nav>