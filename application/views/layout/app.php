<?php
	$path_host  = $this->config->config['base_url'];
	$keyword    = $this->config->config['keyword'];

	// $cookieUser    = json_decode(decode($_COOKIE[$keyword.'user']),true);
    // $authorization = json_decode(decode($_COOKIE[$keyword.'authorization']),true);

	// $gfulllang 	= getLang($_COOKIE[$keyword.'lang']);
	// $glang 		= getLang();

    // debug($_COOKIE);
    // debug($cookieUser['main_username']);

?>
<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Admin Default</title>

    <meta name="description" content="ADMIN DEFAULT" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico');?>">
    <link rel="stylesheet" href="<?php echo $path_host ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $path_host ?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo $path_host ?>assets/css/jquery.gritter.min.css" />
    <link rel="stylesheet" href="<?php echo $path_host ?>assets/css/ace.min.css?v=2018022001" />
    <link rel="stylesheet" href="<?php echo $path_host ?>assets/css/admin-style.css?v=2018022002" />

    <style>
        .dropdown-mobileuser {position: relative;}
        .dropdown-mobileuser .dropdown-menu {top: 0;left: -102%;margin-top: -1px;}
    </style>

    <!-- java scripts -->
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/jquery.2.1.1.min.js"></script>
    <!-- <script type="text/javascript" src="<?php echo $path_host ?>assets/js/jquery-3.2.1.min.js"></script> -->
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/ace-extra.min.js"></script>
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/jquery.gritter.min.js"></script>
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/jquery.countdown.min.js"></script>
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/bootbox.min.js"></script>
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/general.js?v=2018022001"></script>

    <script type="text/javascript">
        var baseUrl = '<?php echo $this->config->config['base_url']; ?>';
    </script>

    <!-- <link rel="stylesheet" href="<?php echo $path_host ?>assets/modules/autocomplete/autocomplete.css" /> -->
<!-- <script type="text/javascript" src="<?php echo $path_host ?>assets/modules/autocomplete/autocomplete.js"></script> -->

    <!-- <script src="assets/js/jquery-ui.min.js"></script> -->
    <!-- <script type="text/javascript" src="<?php echo $path_host ?>assets/js/jquery.2.1.1.min.js"></script> -->
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/jquery-ui.min.js"></script>

</head>
<body class="no-skin">
	
    <div id="navbar" class="navbar navbar-default navbar-fixed-top">

        <script type="text/javascript">
            try{ace.settings.check('navbar' , 'fixed')}catch(e){}
        </script>

        <!-- navbar mobile -->
        <div class="navbar-container" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>

            <div class="dropdown pull-left" id="third-menu" style="">                    
                <button type="button" class="navbar-toggle dropdown-toggle pull-left" data-toggle="dropdown">
                    <span class="sr-only">Toggle User</span>
                    <i class="ace-icon fa fa-cogs bigger-140 white"></i>
                </button>
                <ul class="dropdown-menu pull-left" role="menu" aria-labelledby="menu3">
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" onclick="changePass();">
                            <i class="ace-icon fa fa-eur bigger-100"></i>
                            &nbsp; change_pass
                        </a>
                    </li>
                </ul>
            </div>

            <div class="navbar-header pull-left">
                <a href="" class="navbar-brand">
                    <small>
                        <!-- <i class="fa fa-money"></i> -->
                        STOCK YOTAKA
                    </small>
                </a>
            </div>                

            <div class="dropdown pull-right" id="menu-user">
                <button type="button" class="navbar-toggle dropdown-toggle pull-right" data-toggle="dropdown">
                    <span class="sr-only">Toggle User</span>
                    <i class="ace-icon fa fa-user bigger-140 white"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="menu1">
                    <li role="presentation">
                        <a role="menuitem"  href="#">
                            <i class="ace-icon fa fa-user bigger-100"></i>
                            admin name
                        </a>
                    </li>
                    <li role="presentation" class="dropdown-mobileuser">
                        <a class="a_mobileuser" tabindex="-1" href="#">
                            <i class="ace-icon fa fa-language"></i>
                            <?php if ($_COOKIE[$keyword.'lang']): ?>
                                <?php echo (!empty($gfulllang))? $gfulllang->full_lang : '' ; ?>
                            <?php else: ?>
                                English
                            <?php endif; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                        	<?php if (!empty($glang)): ?>
                        		<?php foreach($glang as $key => $val):?>
                                <li>
	                                <a href="#" onclick="changeLang('<?php echo $val->lang; ?>');">
	                                    <i class="ace-icon fa fa-angle-double-right"></i>
	                                    <font><?php echo $val->full_lang; ?></font>
	                                </a>
	                            </li>
                                <?php endforeach;?>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <script>
                        $(document).ready(function(){
                          $('.dropdown-mobileuser a.a_mobileuser').on("click", function(e){
                            $(this).next('ul').toggle();
                            e.stopPropagation();
                            e.preventDefault();
                          });
                        });
                    </script>
                    <li role="presentation">
                        <a href="<?php echo $path_host; ?>logout">
                            <div class="btn-group">
                                <i class="ace-icon fa fa-power-off bigger-100"></i>
                                &nbsp; logout
                            </div>
                        </a> 
                    </li>
                </ul>
            </div>
    
            <div class="navbar-buttons navbar-header pull-right responsive" role="navigation" id="info">
                <ul class="nav ace-nav">
                    <li class="purple" >
                        <a role="menuitem" tabindex="-1" href="#">                            
                            <div class="btn-group">
                                <i class="ace-icon fa fa-user bigger-140 bg-icon"></i>
                                &nbsp; main_username
                            </div>             
                        </a>                               
                    </li> 
                    <li class="grey" id="drop_lang">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        	English
                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>
                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li class="cur">
                                <a tabindex="-1" onclick="" class="pointer">
                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                    <font>Thailand</font>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="light-blue" id="">
                        <a href="<?php echo $path_host; ?>logout">
                            <div class="btn-group">
                                <i class="ace-icon fa fa-power-off bigger-140 bg-icon-red"></i>
                                &nbsp; logout
                            </div>
                        </a>                                               
                    </li>
                </ul>
            </div>
        </div>
        <!-- end navbar mobile -->
    </div>

    <div class="main-container" id="main-container">

        <script type="text/javascript">
            try{ace.settings.check('main-container' , 'fixed')}catch(e){}
        </script>

        <!-- menu left -->
        <div id="sidebar" class="sidebar responsive sidebar-fixed sidebar-scroll space-top">
            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
            </script>

            <ul class="nav nav-list">
                <li id="main">
                    <a href="<?php echo base_url('main');?>">
                        <i class="menu-icon fa fa-tachometer"></i>
                        <span class="menu-text">Main Menu</span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="open" id="menuActive">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-cogs"></i>
                        <span class="menu-text">
                            สต๊อกนำเข้า
                        </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>
                    <b class="arrow"></b>
                    <ul class="submenu">
                        <li id="manage_quotation">
                            <a href="#" onclick="getMenu('manage_quotation/index');">
                                <i class="menu-icon fa fa-caret-right"></i>
                                สร้างใบเสนอสินค้า
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li id="manage_quotation">
                            <a href="#" onclick="getMenu('manage_quotation/quotation_list');">
                                <i class="menu-icon fa fa-caret-right"></i>
                                ใบเสนอสินค้า
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li id="importOrder">
                            <a href="#" onclick="getMenu('importOrder');">
                                <i class="menu-icon fa fa-caret-right"></i>
                                นำเข้าสินค้า
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>

            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
            </script>
        </div>
        <!-- end menu left -->

        <div class="main-content">
            <div class="main-content-inner">
                <div id="m-breadcrumb">
                    <div class="breadcrumbs" id="breadcrumbs">
                        <div class="row menuSubHead" id="menu-sub">
                            <div class="col-sm-12" id="buttonHead">&nbsp;&nbsp;
                                <span class="label span-head ">
                                    <a href="#" onclick="changePass();">
                                        <i class="ace-icon fa fa-eur bigger-120"></i>
                                        change_pass
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="row headMessage">
                            <div class="col-sm-12" id="">
                                <script type="text/javascript">
                                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                                </script>
                                <div class="col-sm-4" id="breadcrumb">
                                    <ul class="breadcrumb">
                                        <li class="home">
                                            <a href="#" onclick="getMenu('balance');">
                                                <i class="ace-icon fa fa-home home-icon"></i>
                                                home
                                            </a>
                                        </li>
                                        <li class="active li-menu" id="btitle">
                                        	<?php echo (isset($title))? $title : ''; ?>
                                        </li>
                                        <li class="active li-submenu" id="bsubtitle" style="display: none;"><?php echo (isset($sub_title))? $sub_title : ''; ?></li>
                                    </ul>
                                </div>
                                <div class="col-sm-8">
                                    <marquee scorllelay="120" scrollamount="3" style="margin-top: 8px;">
                                        <label class="lighter" style="color:red;">

                                            <?php if (isset($messageShow)): ?>
                                            	<?php echo $messageShow; ?>
                                            <?php else: ?>
                                            	is not message show
											<?php endif; ?>
                                            
                                        </label>
                                    </marquee>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-content" id="pageContent">
                    <?php echo (isset($content))? $content : '';?>
                    <!-- <?php //if(isset($senior)):?>
                        <?php //$senior = //str_replace('memberbet.com','234ag.net',$senior);?>
                        <div style="padding-top:60px;text-align:center;"><?php //echo $senior ?></div>
                    <?php //endif;?> -->
                </div>
            </div>
        </div><!-- /.main-content -->
        <div class="footer" style="display:none;">
            <div class="footer-inner" id="showScore" ></div>
        </div>

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div><!-- /.main-container -->

    <!-- Modal Inactive-->
    <div class="modal fade" id="inactive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="widhth:20%;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">inactive</h4>
          </div>
          <div class="modal-body">
            inac_text
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Check User-->
    <div class="modal fade" id="chkuser" tabindex="-1" role="dialog" aria-labelledby="chkuserLabel" style="widhth:20%;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">xxxx</h4>
          </div>
          <div class="modal-body">
            xxxx
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>
    <div id="showModal"></div>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/datepicker.min.css') ;?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datetimepicker.min.css') ;?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/daterangepicker.min.css') ;?>" />
    <link rel="stylesheet"  href="<?php echo base_url('assets/css/bootstrap-timepicker.min.css'); ?>">

    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datepicker.min.js') ;?>" async></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/moment.min.js') ;?>" async></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/daterangepicker.min.js') ;?>" async></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-timepicker.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/jquery.hotkeys.min.js"></script>
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/bootstrap-wysiwyg.min.js"></script>


    <!-- inline scripts related to this page -->
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/ace-elements.min.js"></script>
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/ace.min.js"></script>
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/autoNumeric-1.5.4.js"></script>
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/admin.js"></script>
    <script type="text/javascript" src="<?php echo $path_host ?>assets/js/jquery.form-validator.min.js"></script>

    <script type="text/javascript">
        $.validate({        
            modules : 'security',                
        });
    </script>
    <script type="text/javascript">

        $.fn.digits = function(){ 
            return this.each(function(){

                if(Number($(this).text().replace(/,/g, "")) < 0){
                    $(this).css('color','#cc0000');
                }
                $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
            })
        }
        $.fn.rmNoVal = function(){ 
            return this.each(function(){ 
                
                if(Number($(this).text().replace(/,/g, "")) == 0){
                    $(this).text('');
                }
            })
        }

        $.fn.load = function(st){ 
            if(st == 'show'){
                return this.addClass('position-relative').append('<div class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div>');
            }else if(st == 'hide'){
                return this.removeClass('position-relative').find('div.widget-box-overlay').remove();
            }
        }

        $.ajaxPrefilter(function( options, original_Options, jqXHR ) {
            options.async = true;
        });

        $(function(){  
  
        });

        $(document).ready(function(){

            // setTimeout(function(){ 
                // chkuser();
                $('.numeric').autoNumeric();
            // }, 5000);

            onInactive(7200000, function(){                    
                $('#inactive').modal('show');                                       
                $('#inactive').on('hidden.bs.modal', function () {
                    window.location = path_host+"logout";
                });
            });

            function onInactive(ms, cb){                
                var wait = setTimeout(cb, ms);
                document.onmousemove = document.mousedown = document.mouseup = document.onkeydown = document.onkeyup = document.focus = function(){
                    clearTimeout(wait);
                    wait = setTimeout(cb, ms);                            
                };
            }

            $(".date-picker").addClass('cur');

            // chang css left footer summaryToday on menu min
            var checkClass = $( "#sidebar" ).hasClass("menu-min");
        
            if(checkClass){
                $("#showScore").css("left","0");
            }else{
                $("#showScore").css("left","200");
            }

            $( "#sidebar-collapse" ).click(function() {

                var checkClass = $( "#sidebar" ).hasClass("menu-min");

                if(checkClass){
                    $("#showScore").css("left","+=200");
                }else{
                    $("#showScore").css("left","0");
                }
            });
            //--
        });


    </script>    
</body>
</html>


