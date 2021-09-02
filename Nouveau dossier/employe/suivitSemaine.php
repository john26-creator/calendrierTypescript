<div class="row">
  <div class="col-2">
   <div id="precedent" class="btn btn-primary" onclick="ChangeSlide2(-1)"><</div>
  </div>
  <div class="col-8"><div align="center"><h1 class="display-1">Suivi Bien &ecirc;tre</h3></div></div>
<div class="col-2">
    <div id="suivant" class="btn btn-primary" onclick="ChangeSlide2(1)">></div>
    </div>
</div>
  

<p class="blockquote">Comment percevez-vous sentez vous au quotidien ?</p></div>



<form id="myform" method="post" onsubmit="submitSuivit(event);">
    <fieldset id="Q1">
        <legend class="display-3">Sommeil</legend>
        <div class="service card-body">
            <p class="card-text blockquote">Avant de d'&eacute;valuer la qualit&eacute; de votre sommeil, posez vous les questions suivantes:
    Avez vous des insomnies :</p>
        <ul class="list-unstyled blockquote">
        <li> - Avant de dormir?</li>
        <li> - Pendant la nuit?</li>
        </ul>  
        </div>
    
	<div class="service card-body">
        <p class="card-text blockquote">Vous levez vous pendant la nuit, ce peut &ecirc;tre pour:</p>
        <ul class="list-unstyled blockquote">
        <li> - Aller manger</li>
        <li> - Fumer</li>
        <li> - Aller aux toilettes</li>
        </ul>
	</div>
	
    <div class="service card-body">
        <p class="card-text blockquote">Vous r&eacute;veillez vous en forme ou fatigu&eacute; le matin?<br/>
    Avez-vous du mal &agrave; vous r&eacute;veiller? <br/>
    En moyenne combien de temps dormez-vous par nuit?<p/>
	</div>
    <br/>
    <div class="service card-body">
        <p class="card-text blockquote">
    <label for="Question1">
           Sur une &eacute;chelle de 1 &agrave; 10 comment dormez-vous?
    </label>
    
    <br />
           <input type="radio" name="Question1" value="1"> 1 </input>
           <input type="radio" name="Question1" value="2"> 2 </input>
           <input type="radio" name="Question1" value="3"> 3 </input>
           <input type="radio" name="Question1" value="4"> 4 </input>
           <input type="radio" name="Question1" value="5"> 5 </input>
           <input type="radio" name="Question1" value="6"> 6 </input>
           <input type="radio" name="Question1" value="7"> 7 </input>
           <input type="radio" name="Question1" value="8"> 8 </input>
           <input type="radio" name="Question1" value="9"> 9 </input>
           <input type="radio" name="Question1" value="10"> 10 </input>
    </p>
    </div>
    </fieldset>

    <fieldset id="Q2">
        <legend class="display-3">Stress</legend>
    <div class="service card-body">
        <p class="card-text blockquote">Avant de d'&eacute;valuer votre taux de stress, vous arrive t'il:</p>
        <ul class="list-unstyled blockquote">
        <li>D'&ecirc;tre irritable?</li>
        <li>De faire des mouvments brusques?</li>
        <li>De cumuler les erreurs?</li>
        <li>D'avoir des r&eacute;actions disproportionn&eacute;es ?</li>
        <li>D'&ecirc;tre tendu?</li>
        <li>De transpirer alors qu'il ne fait pas chaud ?</li>
        <li>D'avoir de noeuds &agrave; l'estomac ?</li>
        </ul>
    </div>

	<div class="service card-body">
        <p class="card-text blockquote">
            <label for="Question2">
                   Sur une &eacute;chelle de 1 &agrave; 10 quel est votre niveau de stress (10 &eacute;tant insupportable)
                   </label>
                   <br />

           <input type="radio" name="Question2" value="1"> 1 </input>
           <input type="radio" name="Question2" value="2"> 2 </input>
           <input type="radio" name="Question2" value="3"> 3 </input>
           <input type="radio" name="Question2" value="4"> 4 </input>
           <input type="radio" name="Question2" value="5"> 5 </input>
           <input type="radio" name="Question2" value="6"> 6 </input>
           <input type="radio" name="Question2" value="7"> 7 </input>
           <input type="radio" name="Question2" value="8"> 8 </input>
           <input type="radio" name="Question2" value="9"> 9 </input>
           <input type="radio" name="Question2" value="10"> 10 </input>
           </p>

	</div>
    </fieldset>

    <fieldset id="Q3">
        <legend class="display-3">Anxiet&eacute;</legend>
    <div class="service card-body">
        <p class="card-text blockquote">
    Avant de d'&eacute;valuer votre taux de anxiet&eacute;, posez vous les questions suivantes. Vous arrive t'il d'avoir :
    </p>
    <ul class="list-unstyled blockquote">
    <li>Des douleurs musculaires ?</li>
    <li>Des palpitations ?</li>
    <li>Des tremblements ?</li>
    <li>Les mains moites ?</li>
    <li>Des vertiges ?</li>
    <li>Des frissons ?</li>
    <li>Des maux de t&ecirc;te ?</li>
    <li>Une sensation de serrement au niveau de la poitrine, l'impression d'&eacute;touffer?</li>
    </ul>
    </div>

	<div class="service card-body">
        <p class="card-text blockquote">
    <label for="Question3">
           Sur une &eacute;chelle de 1 &agrave; 10 quel est votre niveau d’anxi&eacute;t&eacute; (10 &eacute;tant insupportable)
           </label>
           <br />

           <input type="radio" name="Question3" value="1"> 1 </input>
           <input type="radio" name="Question3" value="2"> 2 </input>
           <input type="radio" name="Question3" value="3"> 3 </input>
           <input type="radio" name="Question3" value="4"> 4 </input>
           <input type="radio" name="Question3" value="5"> 5 </input>
           <input type="radio" name="Question3" value="6"> 6 </input>
           <input type="radio" name="Question3" value="7"> 7 </input>
           <input type="radio" name="Question3" value="8"> 8 </input>
           <input type="radio" name="Question3" value="9"> 9 </input>
           <input type="radio" name="Question3" value="10"> 10 </input>
           </p>
           </div>
    </fieldset>
   

    <fieldset id="Q4">
        <legend class="display-3">Energie</legend>
    	<div class="service card-body">
            <p class="card-text blockquote">
            <label for="Question4">
                   Sur une &eacute;chelle de 1 &agrave; 10 quel est votre niveau de vitalit&eacute;.
                   </label>
                   <br />
    
               <input type="radio" name="Question4" value="1"> 1 </input>
               <input type="radio" name="Question4" value="2"> 2 </input>
               <input type="radio" name="Question4" value="3"> 3 </input>
               <input type="radio" name="Question4" value="4"> 4 </input>
               <input type="radio" name="Question4" value="5"> 5 </input>
               <input type="radio" name="Question4" value="6"> 6 </input>
               <input type="radio" name="Question4" value="7"> 7 </input>
               <input type="radio" name="Question4" value="8"> 8 </input>
               <input type="radio" name="Question4" value="9"> 9 </input>
               <input type="radio" name="Question4" value="10"> 10 </input>
              </p>
         </div>
    </fieldset>
    <br />

    <fieldset id="Q5">
        <legend class="display-3">Digestion</legend>
        <div class="service card-body">
        <p class="card-text blockquote">
        Avant de d'&eacute;valuer la qualit&eacute; de votre transit, posez vous les questions suivantes. Souffrez vous de :
        </p>
        <ul class="list-unstyled blockquote">
            <li>Reflux gastriques ?</li>
            <li>Ballonnements ?</li>
            <li>Constipation ?</li>
            <li>Remont&eacute;es acides ?</li>
            <li>diarrh&eacute;e ?</li>
        </ul>
        </div>

    <br/>
    
        <div class="service card-body">
            <p class="card-text blockquote">
            <label for="Question5">
                   Sur une &eacute;chelle de 1 &agrave; 10 comment &eacute;valuez-vous votre digestion
                   </label>
                   <br />
                   <input type="radio" name="Question5" value="1"> 1 </input>
                   <input type="radio" name="Question5" value="2"> 2 </input>
                   <input type="radio" name="Question5" value="3"> 3 </input>
                   <input type="radio" name="Question5" value="4"> 4 </input>
                   <input type="radio" name="Question5" value="5"> 5 </input>
                   <input type="radio" name="Question5" value="6"> 6 </input>
                   <input type="radio" name="Question5" value="7"> 7 </input>
                   <input type="radio" name="Question5" value="8"> 8 </input>
                   <input type="radio" name="Question5" value="9"> 9 </input>
                   <input type="radio" name="Question5" value="10"> 10 </input>
               </p>
         </div>
    </fieldset>

<br/>
    <div id="Q6">
        <div align="center"><button type="submit" id="submit" class="btn btn-lg btn-primary btn-block" name="submit">Envoyer mes réponses</button></div>


      </div>

    </div>
    
</form>
</div>




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
             afin de pouvoir suivre le niveau de bien-&ecirc;tre de l'entreprise. La base l&eacute;gale du traitement est l'inter&ecirc;t l&eacute;gitime.
        	</p>
          <hr>
          <h5>Destinataire et dur&eacute;e de conservation des donn&eacute;es</h5>
          <p>Les donn&eacute;es collect&eacute;es seront communiqu&eacute;es aux seuls destinataires suivants : consultant/auditeur et dirigigeant pour le stress et le niveau globale de bien-&ecirc;tre (c'est &agrave; dire la moyenne des indicateurs) de l'entreprise et par secteur et aux possesseurs de ces informations (l'employer).</p>
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
          <p>La r&eacute;ponse aux 5 questions est obligatoire pour que vous puissiez beneficier du suivit de votre bien-&ecirc;tre en entreprise.</p>
          <p>Si la r&eacute;ponse aux questions n'est pas obligatoire, la non-fourniture des donn&eacute;es p&eacute;nalisera le travail de l'auditeur, qui ne pourra pas &eacute;valuer aussi efficacement:</p>
           <ul>
           	<li>l'amelioration du bien &ecirc;tre de l'entreprise;</li>
           	<li>L'&eacute;volution du stress en entreprise;</li>
           	<li>Les strat&eacute;gies &agrave; effectuer pour am&eacute;liorer la QVT en entreprise;
           </ul>
           <p> Elle penalisera aussi le dirigeant qui aura plus de difficult&eacute;s &agrave; se rendre compte de l'am&eacute;lioration de la QVT dans son entreprise.
           </p>
         </div>
      	<div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      	</div>
     </div>
  </div>
</div>
<div id="errorMessage"> </div>