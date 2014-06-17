<table class="forum" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th class="forum_title"></th>
    <th class="topic_count">Topics</th>
    <th class="message_count">Messages</th>
    <th class="last_message">Last Message</th>
  </tr>
  <?php foreach ($forums as $forum): ?>
  <tr class="forum_row">
    <td><?=link_to($forum->title, '/forum/'.$forum->id)?></td>
    <td><?=$forum->topic_count()?></td>
    <td><?=$forum->post_count()?></td>
    <td>by <?=link_to($forum->latest_post()->user->username, '/user/'. $forum->latest_post()->user->id)?> in <?=link_to(end($forum->topics)->title, '/topic/'. end($forum->topics)->id)?></td>
  </tr>
  <tr >
    <td class="forum_desc" colspan="4">
      <?=$forum->description?>
    </td>
  </tr>
  <?php endforeach ?>
</table>