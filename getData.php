<?php
require 'config.php';

$sql = "SELECT * FROM members";
$data = $conn->query($sql);

if ($data->num_rows > 0) {
  $serial = 0;
  while ($row = $data->fetch_assoc()) {
    $serial++;
?>
    <tr>
      <th scope="row"><?= $serial ?></th>
      <td><?= $row['m_name'] ?></td>
      <td><?= $row['m_email'] ?></td>
      <td><?= $row['m_contact'] ?></td>
      <td><?= $row['m_occupation'] ?></td>
      <td>
        <button class="btn btn-success editMember" type="button" data-toggle="modal" data-target="#exampleModalCenter" data-id="<?= $row['m_id'] ?>" data-name="<?= $row['m_name'] ?>" data-email="<?= $row['m_email'] ?>" data-contact="<?= $row['m_contact'] ?>" data-occupation="<?= $row['m_occupation'] ?>">Edit</button>
        <button class="btn btn-danger deleteMember" data-id="<?= $row['m_id'] ?>">Delete</button>
      </td>
    </tr>

<?php  }
}
?>