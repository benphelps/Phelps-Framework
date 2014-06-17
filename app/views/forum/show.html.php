<table border="0" cellspacing="5" cellpadding="5">
  <tr>
    <th>Topic Title</th>
    <th>Last Author</th>
  </tr>
  <?php foreach ($topics as $topic): ?>
  <tr>
    <td><?=link_to($topic->title, '/topic/'.$topic->id)?></td>
    <td><?=$topic->last_post_user()->username?></td>
  </tr>
  <?php endforeach ?>
</table>