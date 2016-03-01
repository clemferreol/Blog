<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Destinations</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
  <ul class="articles_list">
  <?php foreach($articles as $titre):?>
    <li class="articles" id="article-<?php echo $titre['id_article']?>">
    <?php echo $titre["titre_article"];?>
    <a class="articles-delete" href="#" data-articleid="<?php echo $titre['id_article']?>">X</a>
    </li>
  <?php endforeach;?>
  </ul>

  <form class="articles-add">
    Nom : <input type="name" name="titre_article"><br>
    <input type="submit" value="Add">
  </form>

<script>
$(document).on('click','.articles-delete', function(e){

  var id_article = $(this).data('articleid');

  $.post('/articles/delete',{'id_article':id_article},function(data){
    if(typeof(data.error) != "undefined"){
      alert(data.error);
    }else{
      var deleted_articles = data.id_article
      $('#article-'+deleted_articles).remove();
    }
  },'json')

  e.preventDefault();
})

$(document).on('submit','.articles-add', function(e){

  $.post("/articles/create",$(this).serialize(),function(data){
    if(typeof(data.error) != "undefined"){
      alert(data.error);
    }else{
      var newli = $('<li class="articles" id="article-'+data.id_article+'">'
                    +data.titre_article
                    +' <a class="articles-delete" href="#" data-articleid="'
                    +data.id_article+'">X</a></li>');
      $('.articles_list').append(newli);
      $('.article-add input[name=titre_article]').val("");
    }
  },'json');

  return false;
});
</script>

</body>
</html>
