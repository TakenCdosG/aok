<?php
/**
 * Template Name: Search page es_ES
 */
?>
<?php get_header(); ?> 
<div class="container search">
  <div class="border">
    <div class="row">
      <div class="col-lg-12 nav-head">
        <?php require_once('includes/nav.php'); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
          <h2>Búsqeda</h2>
      </div>
    </div>
    <?php
    if (!is_user_logged_in()) {
      $redirect = home_url() . '/wp-login.php?redirect_to=' . urlencode( $_SERVER['REQUEST_URI'] );
      $register =  home_url() . '/register?redirect_to=' . urlencode( $_SERVER['REQUEST_URI'] );

      echo('<div class="row"><div class="col-lg-12">¿Estas buscando Cuidado Infantil? Si es así, <a href="'.$register.'">Regístrese aquí </a> <br> ¿Ya está Registrado?  <a href="'.$redirect.'">Ingrese aquí</a> </div></div>');
    } else {?>
    <div class="row">
      <div class="col-lg-5">
        
      </div>
      <div class="col-lg-7">
          <form action="<?php echo site_url(); ?>/search-results" method="POST">
            <input type="hidden" id="current_lang" name="current_lang" value="<?php echo $current_lang; ?>">
            <div class="half field">
              <label for="fname">Nombre: </label>
              <input id="fname" type="text" name="fname" label="First Name" ></input>
            </div>
             <div class="half field" style="margin-left:3%;">
              <label for="lname">Apellido: </label>
              <input id="lname" type="text" name="lname" label="Last Name" ></input>
            </div>
            <div class="clearfix"></div>
            <div class="full field">
              <label for="ccname">Nombre de Cuidado Infantil: </label>
              <input id="ccname" type="text" name="ccname" label="Child Care Name" ></input>
            </div>
            <div class="clearfix"></div>
            <div class="half field">
              <label for="age">Edades: </label>
              <select id="age" name="age" label="Age" >
                <option value="">- Selecciona el grupo de edades -</option>
                <?php
                $field_key = "field_577d22859ee8c";
                $field = get_field_object($field_key);

                if( $field )
                {
                  foreach( $field['choices'] as $k => $v )
                  {
                      echo '<option value="' . $k . '">' . $v . '</option>';
                  }  
                }
                ?>
              </select> 
            </div>
            <div class="one field">
              <label for="zip">Codigo Postal: </label>
              <input type="text" id="zip" name="zip" label="ZIP Code" ></input>
            </div>
            <div class="one field">
              <label for="lang">Idioma Hablado: </label>
              <select id="lang" name="lang" label="Language Spoken" multiple="multiple">
                <option value="English">English</option>
                <option value="Spanish">Spanish</option>
              </select>
            </div>
            <div class="one field">
              <label for="cop">Vacantes: </label>
              <input id="copyes" type="checkbox" name="cop" value="yes" >SI</input> 
              <input style="margin-left:10px;" id="copno" type="checkbox" name="cop" value="no">NO</input>
            </div>
            <div class="one field">
              <label for="">Marque los que apliquen: </label>
              <input id="opeve" type="checkbox" value="1">Abierto en tarde/noche </input>
              <input style="margin-left:10px;" id="opweek" type="checkbox" value="2">Abierto fines de semana </input>
              <br>
              <input id="cfork" type="checkbox" value="3">Acepta Care4Kids </input>
              <input style="margin-left:10px;" id="cam" type="checkbox" value="4">Certificado para Administrar Medicamentos </input>
              <p></p>
              <input id="submit" class="ajax" type="submit" value="Buscar">
            </div>
          </form>
      </div>
    </div>

    <div class="count-results"></div>
    <div id="results">
        
    </div>
  </div>
</div>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/includes/multiple-select.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/includes/ajax-search.js"></script>

<?php
}
?>

<?php get_footer(); ?>
