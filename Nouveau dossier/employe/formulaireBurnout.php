<div style="margin-top:40px;">
<div class="row">
	<div class="col-2">
   <div id="precedent" class="btn btn-primary" onclick="ChangeSlide(-1)"><</div>
  </div>
	<div class="col-8"><h1 class="display-2">Taux de Stress MBI</h1></div>
<div class="col-2">
    <div id="suivant" class="btn btn-primary" onclick="ChangeSlide(1)">></div>
    </div>
</div>
<div class="service card-body">
   <p class="card-text blockquote">
	Pr&eacute;cisez la fr&eacute;quence &agrave; laquelle vous ressentez la description des propositions suivantes en entourant le chiffre correspondant avec :
	</p>
<p class="card-text blockquote">
0 = Jamais
1 = Quelques fois par an, au moins
2 = Une fois par mois au moins
3 = Quelques fois par mois
4 = Une fois par semaine
5 = Quelques fois par semaine
6 = Chaque jour
</p>

</div>

<form method="post" id="myform" onsubmit="submitBurnout(event, <?php echo $_POST['bilan']?>)">
    <div id="Q1">
<fieldset >
    <legend class="display-4">Question 1</legend>
     <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question1">
       Je me sens &eacute;motionnellement vid&eacute;(e) par mon travail
       </label>
       <br/>

	   <input type="radio" name="Question1" value="0"> 0 </input>
	   <input type="radio" name="Question1" value="1"> 1 </input>
	   <input type="radio" name="Question1" value="2"> 2 </input>
	   <input type="radio" name="Question1" value="3"> 3 </input> 
	   <input type="radio" name="Question1" value="4"> 4 </input> 
	   <input type="radio" name="Question1" value="5"> 5 </input> 
	   <input type="radio" name="Question1" value="6"> 6 </input> 
	   </p>
	   </div>
</fieldset>


<fieldset >
    <legend class="display-4">Question 2</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question2">
       Je me sens &agrave; bout &agrave; la fin de ma journ&eacute;e de travail
       </label>
       <br/>
	   
	   <input type="radio" name="Question2" value="0"> 0 </input>
	   <input type="radio" name="Question2" value="1"> 1 </input>
	   <input type="radio" name="Question2" value="2"> 2 </input>
	   <input type="radio" name="Question2" value="3"> 3 </input> 
	   <input type="radio" name="Question2" value="4"> 4 </input> 
	   <input type="radio" name="Question2" value="5"> 5 </input> 
	   <input type="radio" name="Question2" value="6"> 6 </input> 
	   </p></div>
</fieldset>


<fieldset >
    <legend class="display-4">Question 3</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question3">
       Je me sens fatigu&eacute;(e) lorsque je me l&egrave;ve le matin et que j'ai &agrave; affronter une autre journ&eacute;e de travail
       </label>
       <br/>
	   <input type="radio" name="Question3" value="0"> 0 </input>
	   <input type="radio" name="Question3" value="1"> 1 </input>
	   <input type="radio" name="Question3" value="2"> 2 </input>
	   <input type="radio" name="Question3" value="3"> 3 </input> 
	   <input type="radio" name="Question3" value="4"> 4 </input> 
	   <input type="radio" name="Question3" value="5"> 5 </input> 
	   <input type="radio" name="Question3" value="6"> 6 </input> 
	   </p>
	   </div>
</fieldset>

<fieldset>
    <legend class="display-4">Question 4</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question4">
       Je peux comprendre facilement ce que mes patients/clients/&eacute;l&egrave;ves ressentent
       </label>
       <br/>
	   <input type="radio" name="Question4" value="0"> 0 </input>
	   <input type="radio" name="Question4" value="1"> 1 </input>
	   <input type="radio" name="Question4" value="2"> 2 </input>
	   <input type="radio" name="Question4" value="3"> 3 </input> 
	   <input type="radio" name="Question4" value="4"> 4 </input> 
	   <input type="radio" name="Question4" value="5"> 5 </input> 
	   <input type="radio" name="Question4" value="6"> 6 </input> 
	   </p>
	   </div>
</fieldset>


<fieldset>
    <legend class="display-4">Question 5</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question5">
       Je sens que je m'occupe de certains patients/clients/&eacute;l&egrave;ves de fa&ccedil;on impersonnelle, comme s'ils &eacute;taient des objets
       </label>
       <br/>
	   <input type="radio" name="Question5" value="0"> 0 </input>
	   <input type="radio" name="Question5" value="1"> 1 </input>
	   <input type="radio" name="Question5" value="2"> 2 </input>
	   <input type="radio" name="Question5" value="3"> 3 </input> 
	   <input type="radio" name="Question5" value="4"> 4 </input> 
	   <input type="radio" name="Question5" value="5"> 5 </input> 
	   <input type="radio" name="Question5" value="6"> 6 </input> 
	   </p>
	   </div>
</fieldset>
    </div>

<div id="Q2">
<fieldset>
    <legend class="display-4">Question 6</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question6">
       Travailler avec des gens tout au long de la journ&eacute;e me demande beaucoup d'effort
</label><br/>
		
	   <input type="radio" name="Question6" value="0"> 0 </input>
	   <input type="radio" name="Question6" value="1"> 1 </input>
	   <input type="radio" name="Question6" value="2"> 2 </input>
	   <input type="radio" name="Question6" value="3"> 3 </input> 
	   <input type="radio" name="Question6" value="4"> 4 </input> 
	   <input type="radio" name="Question6" value="5"> 5 </input> 
	   <input type="radio" name="Question6" value="6"> 6 </input> 
	   </p>
	   </div>
</fieldset>


<fieldset>
    <legend class="display-4">Question 7</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question7">
       Je m'occupe tr&egrave;s efficacement des probl&egrave;mes de mes patients/clients/&eacute;l&egrave;ves
</label>
<br/>
	   <input type="radio" name="Question7" value="0"> 0 </input>
	   <input type="radio" name="Question7" value="1"> 1 </input>
	   <input type="radio" name="Question7" value="2"> 2 </input>
	   <input type="radio" name="Question7" value="3"> 3 </input> 
	   <input type="radio" name="Question7" value="4"> 4 </input> 
	   <input type="radio" name="Question7" value="5"> 5 </input> 
	   <input type="radio" name="Question7" value="6"> 6 </input> 
	   </p>
	   </div>
</fieldset>


<fieldset>
    <legend class="display-4">Question 8</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question8">
       Je sens que je craque &agrave; cause de mon travail
       </label>
       <br/>
	   <input type="radio" name="Question8" value="0"> 0 </input>
	   <input type="radio" name="Question8" value="1"> 1 </input>
	   <input type="radio" name="Question8" value="2"> 2 </input>
	   <input type="radio" name="Question8" value="3"> 3 </input> 
	   <input type="radio" name="Question8" value="4"> 4 </input> 
	   <input type="radio" name="Question8" value="5"> 5 </input> 
	   <input type="radio" name="Question8" value="6"> 6 </input> 
	   </p>
	   </div>
</fieldset>


<fieldset>
    <legend class="display-4">Question 9</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question9">
       J'ai l'impression, &agrave; travers mon travail, d'avoir une influence positive sur les gens
       </label><br/>
       
	   <input type="radio" name="Question9" value="0"> 0 </input>
	   <input type="radio" name="Question9" value="1"> 1 </input>
	   <input type="radio" name="Question9" value="2"> 2 </input>
	   <input type="radio" name="Question9" value="3"> 3 </input> 
	   <input type="radio" name="Question9" value="4"> 4 </input> 
	   <input type="radio" name="Question9" value="5"> 5 </input> 
	   <input type="radio" name="Question9" value="6"> 6 </input> 
	   </p>
	   </div>
</fieldset>


<fieldset>
    <legend class="display-4">Question 10</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question10">
       Je suis devenu(e) plus insensible aux gens depuis que j'ai ce travail
       </label><br/>
       
	   <input type="radio" name="Question10" value="0"> 0 </input>
	   <input type="radio" name="Question10" value="1"> 1 </input>
	   <input type="radio" name="Question10" value="2"> 2 </input>
	   <input type="radio" name="Question10" value="3"> 3 </input> 
	   <input type="radio" name="Question10" value="4"> 4 </input> 
	   <input type="radio" name="Question10" value="5"> 5 </input> 
	   <input type="radio" name="Question10" value="6"> 6 </input> 
	   </p>
	   </div>
</fieldset>
</div>
    <div id="Q3">
<fieldset>
    <legend class="display-4">Question 11</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question11">
       Je crains que ce travail ne m'endurcisse &eacute;motionnellement
       </label>
       <br>
       
	   <input type="radio" name="Question11" value="0"> 0 </input>
	   <input type="radio" name="Question11" value="1"> 1 </input>
	   <input type="radio" name="Question11" value="2"> 2 </input>
	   <input type="radio" name="Question11" value="3"> 3 </input> 
	   <input type="radio" name="Question11" value="4"> 4 </input> 
	   <input type="radio" name="Question11" value="5"> 5 </input> 
	   <input type="radio" name="Question11" value="6"> 6 </input> 
	   </p></div>
</fieldset>


<fieldset>
    <legend class="display-4">Question 12</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question12">
       Je me sens plein(e) d'&eacute;nergie
       </label><br/>
       
	   <input type="radio" name="Question12" value="0"> 0 </input>
	   <input type="radio" name="Question12" value="1"> 1 </input>
	   <input type="radio" name="Question12" value="2"> 2 </input>
	   <input type="radio" name="Question12" value="3"> 3 </input> 
	   <input type="radio" name="Question12" value="4"> 4 </input> 
	   <input type="radio" name="Question12" value="5"> 5 </input> 
	   <input type="radio" name="Question12" value="6"> 6 </input> 
	   </p></div>
</fieldset>


<fieldset>
    <legend class="display-4">Question 13</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question13">
       Je me sens frustr&eacute;(e) par mon travail
       </label><br/>
       
	   <input type="radio" name="Question13" value="0"> 0 </input>
	   <input type="radio" name="Question13" value="1"> 1 </input>
	   <input type="radio" name="Question13" value="2"> 2 </input>
	   <input type="radio" name="Question13" value="3"> 3 </input> 
	   <input type="radio" name="Question13" value="4"> 4 </input> 
	   <input type="radio" name="Question13" value="5"> 5 </input> 
	   <input type="radio" name="Question13" value="6"> 6 </input>
	   </p></div> 
</fieldset>


<fieldset>
    <legend class="display-4">Question 14</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question14">
       Je sens que je travaille « trop dur » dans mon travail
       </label><br/>
       
	   <input type="radio" name="Question14" value="0"> 0 </input>
	   <input type="radio" name="Question14" value="1"> 1 </input>
	   <input type="radio" name="Question14" value="2"> 2 </input>
	   <input type="radio" name="Question14" value="3"> 3 </input> 
	   <input type="radio" name="Question14" value="4"> 4 </input> 
	   <input type="radio" name="Question14" value="5"> 5 </input> 
	   <input type="radio" name="Question14" value="6"> 6 </input> 
	   </p>
	   </div>
</fieldset>


<fieldset>
    <legend class="display-4">Question 15</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question15">
       Je ne me soucie pas vraiment de ce qui arrive &agrave; certains de mes patients/clients/&eacute;l&egrave;ves
       </label><br/>
       
	   <input type="radio" name="Question15" value="0"> 0 </input>
	   <input type="radio" name="Question15" value="1"> 1 </input>
	   <input type="radio" name="Question15" value="2"> 2 </input>
	   <input type="radio" name="Question15" value="3"> 3 </input> 
	   <input type="radio" name="Question15" value="4"> 4 </input> 
	   <input type="radio" name="Question15" value="5"> 5 </input> 
	   <input type="radio" name="Question15" value="6"> 6 </input> 
	   </p></div>
</fieldset>
    </div>
<div id="Q4">
<fieldset>
    <legend class="display-4">Question 16</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question16">
       Travailler en contact direct avec les gens me stresse trop
       </label><br/>
       
	   <input type="radio" name="Question16" value="0"> 0 </input>
	   <input type="radio" name="Question16" value="1"> 1 </input>
	   <input type="radio" name="Question16" value="2"> 2 </input>
	   <input type="radio" name="Question16" value="3"> 3 </input> 
	   <input type="radio" name="Question16" value="4"> 4 </input> 
	   <input type="radio" name="Question16" value="5"> 5 </input> 
	   <input type="radio" name="Question16" value="6"> 6 </input> 
	   </p></div>
</fieldset>


<fieldset>
    <legend class="display-4">Question 17</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question17">
       J'arrive facilement &agrave; cr&eacute;er une atmosph&egrave;re d&eacute;tendue avec mes patients/clients/&eacute;l&egrave;ves
       </label><br/>
       
	   <input type="radio" name="Question17" value="0"> 0 </input>
	   <input type="radio" name="Question17" value="1"> 1 </input>
	   <input type="radio" name="Question17" value="2"> 2 </input>
	   <input type="radio" name="Question17" value="3"> 3 </input> 
	   <input type="radio" name="Question17" value="4"> 4 </input> 
	   <input type="radio" name="Question17" value="5"> 5 </input> 
	   <input type="radio" name="Question17" value="6"> 6 </input>
	   </p></div> 
</fieldset>


<fieldset >
    <legend class="display-4">Question 18</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question18">
       Je me sens ragaillardi(e) lorsque dans mon travail j'ai &eacute;t&eacute; proche de patients/clients/&eacute;l&egrave;ves
       </label><br/>
       
	   <input type="radio" name="Question18" value="0"> 0 </input>
	   <input type="radio" name="Question18" value="1"> 1 </input>
	   <input type="radio" name="Question18" value="2"> 2 </input>
	   <input type="radio" name="Question18" value="3"> 3 </input> 
	   <input type="radio" name="Question18" value="4"> 4 </input> 
	   <input type="radio" name="Question18" value="5"> 5 </input> 
	   <input type="radio" name="Question18" value="6"> 6 </input> 
	   </p></div>
</fieldset>


<fieldset>
    <legend  class="display-4">Question 19</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question19">
       J'ai accompli beaucoup de choses qui en valent la peine dans ce travail
       </label><br/>
       
	   <input type="radio" name="Question19" value="0"> 0 </input>
	   <input type="radio" name="Question19" value="1"> 1 </input>
	   <input type="radio" name="Question19" value="2"> 2 </input>
	   <input type="radio" name="Question19" value="3"> 3 </input> 
	   <input type="radio" name="Question19" value="4"> 4 </input> 
	   <input type="radio" name="Question19" value="5"> 5 </input> 
	   <input type="radio" name="Question19" value="6"> 6 </input> 
	   </p></div>
</fieldset>


<fieldset>
    <legend class="display-4">Question 20</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question20">
       Je me sens au bout du rouleau
       </label><br/>
       
	   <input type="radio" name="Question20" value="0"> 0 </input>
	   <input type="radio" name="Question20" value="1"> 1 </input>
	   <input type="radio" name="Question20" value="2"> 2 </input>
	   <input type="radio" name="Question20" value="3"> 3 </input> 
	   <input type="radio" name="Question20" value="4"> 4 </input> 
	   <input type="radio" name="Question20" value="5"> 5 </input> 
	   <input type="radio" name="Question20" value="6"> 6 </input> 
	   </p></div>
</fieldset>
</div>
<div id="Q5">
    <fieldset >
    <legend class="display-4">Question 21</legend>
     <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question21">
       Dans mon travail, je traite les probl&egrave;mes &eacute;motionnels tr&egrave;s calmement
       </label><br/>
       
	   <input type="radio" name="Question21" value="0"> 0 </input>
	   <input type="radio" name="Question21" value="1"> 1 </input>
	   <input type="radio" name="Question21" value="2"> 2 </input>
	   <input type="radio" name="Question21" value="3"> 3 </input> 
	   <input type="radio" name="Question21" value="4"> 4 </input> 
	   <input type="radio" name="Question21" value="5"> 5 </input> 
	   <input type="radio" name="Question21" value="6"> 6 </input> 
	   </p></div>
</fieldset>


<fieldset>
    <legend class="display-4">Question 22</legend>
     <div class="service card-body">
        <p class="card-text blockquote">
<label for="Question22">
       J'ai l'impression que mes patients/clients/&eacute;l&egrave;ves me rendent responsable de certains de leurs probl&egrave;mes
       </label><br/>
       
	   <input type="radio" name="Question22" value="0"> 0 </input>
	   <input type="radio" name="Question22" value="1"> 1 </input>
	   <input type="radio" name="Question22" value="2"> 2 </input>
	   <input type="radio" name="Question22" value="3"> 3 </input> 
	   <input type="radio" name="Question22" value="4"> 4 </input> 
	   <input type="radio" name="Question22" value="5"> 5 </input> 
	   <input type="radio" name="Question22" value="6"> 6 </input> 
	   </p></div>
</fieldset>


<fieldset>
    <legend>Envoyer mes r&eacute;ponses</legend>
	
</fieldset>
<fieldset>
	<button type="submit" id="submit" class="btn btn-lg btn-primary btn-block" name="submit">Envoyer mes r&eacute;ponses</button>
</fieldset>
</div>

</form>
<div class="modal fade" id="cguModal" tabindex="-1" role="dialog" aria-labelledby="modalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Condition g&eacute;n&eacute;rales d'utilisation des donn&eacute;es personnelles</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            	<span aria-hidden="true">&times;</span>
        	</button>
        </div>
         <div class="modal-body">
          <h5>Informations g&eacute;n&eacute;rales</h5>
          <p>Les informations recueillies sur ce formulaire sont enregistr&eacute;es dans un fichier informatis&eacute; par Jonathan AMSELEM jonathan.amselem.pro@gmail.com, 
             afin de pouvoir &eacute;valuer l'&eacute;tat physique et &eacute;motionnel g&eacute;n&eacute;ral et par secteur au sein de l'entreprise. La base l&eacute;gale du traitement est l'inter&ecirc;t l&eacute;gitime.
        	</p>
          <hr>
          <h5>Destinataire et dur&eacute;e de conservation des donn&eacute;es</h5>
          <p>Les donn&eacute;es collect&eacute;es seront communiqu&eacute;es aux seuls destinataires suivants : consultant/auditeur et dirigigeant pour le stress et le niveau globale de bien-&ecirc;tre (c'est &agrave; dire la moyenne des indicateurs) de l'entreprise et par secteur et au possesseurs de ces informations (l'employer).</p>
          <p>Les donn&eacute;es sont conserv&eacute;es pendant durant la dur&eacute;e de l'audit et de son suivi et au plus tard 5ans apr&egrave;s leur transmissions.</p>
          <hr>
          <h5>Vos droits concernant les donn&eacute;es</h5>
           <ul>
          	<li>Vous pouvez acc&eacute;der aux donn&eacute;es vous concernant, les rectifier, demander leur effacement ou exercer votre droit &agrave; la limitation du traitement de vos donn&eacute;es.</li> 
        	<li>Vous pouvez retirer &agrave; tout moment votre consentement au traitement de vos donn&eacute;es;</li>
        	<li>Vous pouvez &eacute;galement vous opposer au traitement de vos donn&eacute;es;</li>
        	<li>Vous pouvez &eacute;galement exercer votre droit &agrave; la portabilit&eacute; de vos donn&eacute;es</li>
          </ul>
          <p> Consultez le site <a class="stretched-link" href="cnil.fr">cnil.fr</a> pour plus d'informations sur vos droits.</p>
          <hr>
          <h5>Comment exercer vos droits</h5>
          <p>Pour exercer ces droits ou pour toute question sur le traitement de vos donn&eacute;es dans ce dispositif, vous pouvez contacter l'administrateur :<br/> 
        	jonathan.amselem.pro@gmail.com,<br/> 
        	121 Bis boulevard Napol&eacute;on 3,<br/> 
        	+336 98 61 21 51.</p>
        	<p>Si vous estimez, apr&egrave;s nous avoir contact&eacute;s, que vos droits "Informatique et Libert&eacute;s" ne sont pas respect&eacute;s, vous pouvez adresser une r&eacute;clamation &agrave; la CNIL.</p>
          <hr>
          <h5>Avertissement</h5>
          <p>La r&eacute;ponse aux 22 questions est obligatoire pour que vous puissiez beneficier du r&eacute;sultat de votre test MBI (physique et &eacute;motionnel).</p>
          <p>Si la r&eacute;ponse aux questions n'est pas obligatoire, la non-fourniture des donn&eacute;es p&eacute;nalisera le travail de l'auditeur, qui ne pourra pas &eacute;valuer aussi efficacement:</p>
           <ul>
           	<li>Les endroits dans l'entreprise prioritaires;</li>
           	<li>Les difficult�s principales des l'entreprise;</li>
           	<li>Les strat&eacute;gies &agrave; effectuer pour am&eacute;liorer la QVT en entreprise;
           </ul>
           <p> Elle penalisera aussi le dirigeant qui aura plus de difficult&eacute;s &agrave; se rendre compte de l'&eacute;tat de son entreprise.
           </p>
         </div>
      	<div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      	</div>
     </div>
  </div>
</div>
<div id="errorMessage"> </div>