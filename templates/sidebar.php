<div class="" >
<div class="side-menu">
    <?php if ($post->post_parent)
        $children = wp_list_pages("title_li=&child_of=" . $post->post_parent . "&echo=0"); else
        $children = wp_list_pages("title_li=&child_of=" . $post->ID . "&echo=0");
    if ($children) { ?>
        <ul>

            <?php echo $children; ?>

        </ul>
    <?php } ?>
</div>
<div class="questions">
    <h4>Остались вопросы?</h4>
    <p>Наши специалисты проконсультируют вас по любому вопросу по бесплатному телефону</p>
   <ul>
            <li><a href="tel:88129233323">+7 (812) 925-33-83</a></li>
    </ul> 
</div>
</div>

<div class="questions">
<a  class="btn" href="kaka.su/about-the-company/training-apartments/">Подготовка квартиры</a>
</div>
<?php dynamic_sidebar('sidebar-primary'); ?>
