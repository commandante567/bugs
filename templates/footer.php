<footer class="main-footer" role="contentinfo" >
    <div class="container">
        <div class="row">
            <div class="col-md-3 contacts">
                <p class="city">Ярославль и вся область</p>
                <p class="phone"><a href="tel:88129233323">+7 (910) 967-61-41</a></p>
                <p class="email"><a href="mailto:obrab77@mail.ru">obrab77@mail.ru</a></p>
            </div>
            <div class="col-md-9 menus">
                <div class="col-md-3">
                    <div class="b-footer-menu-title">
                        <h4>O Компании</h4>
                    </div>
                    <div class="b-footer-menu">
                        <ul>
                            <?php
                            $menu1 = array(
                                'title_li' => null,
                                'child_of' => 0,
                                'depth' => 1,
                                'exclude'      => '508, 169,191,142',
                                'post_type' => 'page',
                                'post_status' => 'publish',
								'exclude'      => '2073, 2483',
                            );

                            wp_list_pages($menu1); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                     <div class="b-footer-menu-title">
                        <h4>Для Квартиры</h4>
                    </div>
                    <div class="b-footer-menu">
                        <ul>
                            <?php
                            $menu1 = array(
                                'title_li' => null,
                                'child_of' => 142,
                                'depth' => 1,
                                'post_type' => 'page',
                                'post_status' => 'publish',


                            );

                            wp_list_pages($menu1); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="b-footer-menu-title">
                        <h4>Для Организаций</h4>
                    </div>
                    <div class="b-footer-menu">
                        <ul>
                            <?php
                            $menu1 = array(
                                'title_li' => null,
                                'child_of' => 191,
                                'depth' => 1,
                                'post_type' => 'page',
                                'post_status' => 'publish',


                            );

                            wp_list_pages($menu1); ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="b-footer-menu-title">
                        <h4>Для участков</h4>
                    </div>
                    <div class="b-footer-menu">
                        <ul>
                           <?php
                            $menu1 = array(
                                'title_li' => null,
                                'child_of' => 169,
                                'depth' => 1,
                                'post_type' => 'page',
                                'post_status' => 'publish',


                            );

                            wp_list_pages($menu1); ?> 
                       </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="footer-hr">
        <div class="row copyright">
            <div class="col-md-12">
                <p>Ярославская городская санитарная служба</p>
            </div>
        </div>
    </div>
</footer>


<div class="modal modal-vcenter fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Заказать звонок или задать вопрос</h4>
      </div>
      <div class="modal-body">
        <p>Пожалуйста, укажите свои контактные данные и ваш вопрос. Наши специалисты ответят на него в самые кратчайшие сроки.</p>
        <?php echo do_shortcode('[contact-form-7 id="365" title="Основная"]'); ?>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
