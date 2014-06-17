<table border="0" cellspacing="5" cellpadding="5">
  <tr>
    <th>Topic Title</th>
  </tr>
  <?php foreach ($topics as $topic): ?>
  <tr>
    <td><?=link_to($topic->title, '/post/'.$topic->id)?></td>
  </tr>
  <?php endforeach ?>
</table>


<table border="0" cellspacing="5" cellpadding="5">
  <tr>
    <th>Topic</th>
    <th>Post</th>
  </tr>
  <?php foreach ($posts as $post): ?>
  <tr>
    <td><?=link_to($post->topic->title, '/topic/'.$post->topic->id)?></td>
    <td>
      <?=$post->post?>
    </td>
  </tr>
  <?php endforeach ?>
</table>