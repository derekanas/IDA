<?php         
    hide($form['copy']);
    $form['message']['#resizable'] = FALSE;
    $form['name']['#attributes']['placeholder'] = 'Name';
    unset($form['name']['#attributes']['class']);
    unset($form['name']['#theme_wrappers']);
    unset($form['name']['#title']);
    $form['mail']['#attributes']['placeholder'] = 'E-mail';
    unset($form['mail']['#title']);
    unset($form['mail']['#attributes']['class']);
    unset($form['mail']['#theme_wrappers']);
    $form['subject']['#attributes']['placeholder'] = 'Subject';
    unset($form['subject']['#title']);
    unset($form['subject']['#attributes']['class']);
    unset($form['subject']['#theme_wrappers']);
    $form['message']['#attributes']['placeholder'] = 'Message';
    unset($form['message']['#title']);
    unset($form['message']['#attributes']['class']);
    unset($form['message']['#theme_wrappers']);
    unset( $form['actions']['submit']['#attributes']['class']);
    $form['actions']['submit']['#attributes']['class'][] = 'submit-btn';
?>
<div id="contact-form">

            <?php print render($form['name']); ?>
        
            <?php print render($form['mail']); ?>
        
            <?php print render($form['subject']); ?>
       
            <?php print render($form['message']); ?>
    
            <?php print render($form['actions']); ?>        
   
</div>

<?php print drupal_render_children($form); ?>
