<div class="main">
   <h2 class="header">Your MOT History</h2>
   <div>
      Registration Number: <?= $result['registration'] ?><br />
      Make: <?= $result['make'] ?><br />
      Model: <?= $result['model'] ?><br />
      Colour: <?= $result['colour'] ?><br />
      MOT expiry date: <?= $result['expiryDate'] ?><br />
      The number of failed MOTs: <?= $result['countFaild'] ?><br />
   </div>
   <h4 class="go-back-button" onclick="history.back()">Back to form</h4>
</div>