<table border="0" cellspacing="5" cellpadding="5">
  <tr>
    <th>Post Author</th>
    <th>Post</th>
  </tr>
  <?php foreach ($posts as $post): ?>
  <tr>
    <td><?=link_to($post->user->username, '/user/'.$post->user->id)?></td>
    <td>
      
      <strong><?=$post->title?></strong><br>
      <?=$post->post?>
        
        
    </td>
  </tr>
  <?php endforeach ?>
</table>