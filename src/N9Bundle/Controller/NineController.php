<?php

namespace N9Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

//use N9Bundle\Entity\Contact;
//use N9Bundle\Form\ContactType;

class NineController extends Controller
{
    private $listPages = array(
        'index' => array (
            'label' => "index",
            'route' => "",
            'title' => "Index",
            'name'  => "Accueil",
            'icon'  => "home",
        ),
        'experience' => array (
            'label' => "experience",
            'route' => "experience",
            'title' => "Expérience professionnelle",
            'name'  => "Expérience",
            'icon'  => "class",
        ),
        'competences' => array (
            'label' => "competences",
            'route' => "competences",
            'title' => "Compétences",
            'name'  => "Compétences",
            'icon'  => "assessment",
        ),
        'formation' => array (
            'label' => "formation",
            'route' => "formation",
            'title' => "Formation",
            'name'  => "Formation",
            'icon'  => "stars",
        ),
        'projets' => array (
            'label' => "projets",
            'route' => "projets",
            'title' => "Projets",
            'name'  => "Projets",
            'icon'  => "description",
        ),
        'creations' => array (
            'label' => "creations",
            'route' => "creations",
            'title' => "Mes créations",
            'name'  => "Créations",
            'icon'  => "dashboard",
        ),
        'photos' => array (
            'label' => "photos",
            'route' => "photos",
            'title' => "Mes photos",
            'name'  => "Photos",
            'icon'  => "perm_media",
        ),
    );
    
    private $listLinks = array(
        'linkedin' => array (
            'label'     => "linkedin",
            'url'       => "http://fr.linkedin.com/in/carolinenoyer",
            'title'     => "Profil LinkedIn",
            'tooltip'   => "Mon profil LinkedIn",
        ),
        'viadeo' => array (
            'label'     => "viadeo",
            'url'       => "http://www.viadeo.com/fr/profile/carolinenoyer",
            'title'     => "Profil Viadeo",
            'tooltip'   => "Mon profil Viadeo",
        ),
        'doyoubuzz' => array (
            'label'     => "doyoubuzz",
            'url'       => "http://www.doyoubuzz.com/caroline-noyer",
            'title'     => "Profil DoYouBuzz",
            'tooltip'   => "Mon profil DoYouBuzz",
        ),
       /* 'cv' => array (
            'label'     => "cv-pdf",
            'url'       => "https://docs.carolinenoyer.info/pdf/cv-devwebfullstack.pdf",
            'title'     => "CV - Caroline Noyer",
            'tooltip'   => "Mon CV au format PDF",
        ),*/
    );
    
    private $listLibrairies = array(
        'materializecss' => array (
            'title'     => "Materialize",
            'url'       => "http://materializecss.com",
        ),
        'jquery' => array (
            'title'     => "jQuery",
            'url'       => "https://jquery.com",
        ),
        'modernizr' => array (
            'title'     => "Modernizr",
            'url'       => "https://modernizr.com/",
        ),
        'animatecss' => array (
            'title'     => "Animate.css",
            'url'       => "https://daneden.github.io/animate.css/",
        ),
        'hovercss' => array (
                'title'     => "Hover.css",
                'url'       => "http://ianlunn.github.io/Hover/",
        ),
        'jqscrollfire' => array (
                'title'     => "jquery.scrollfire",
                'url'       => "https://github.com/Xaxis/jquery.scrollfire",
        ),
    );
    
    
    public function indexAction(Request $request)
    {
        $data['listLibrairies'] = $this->listLibrairies;
        $data['baseUrl'] = $request->getBaseUrl();
        $data['basePath'] = $request->getBasePath();
        
        $content = $this->render('N9Bundle:Nine:index.html.twig', $data);
        
        return $content;
    }
    
    public function menuAction(Request $request)
    {
        $page = $request->get('page', '');
        
        $content = $this->render(
            'N9Bundle:Nine:menu.html.twig', 
            array(
                'activePage' => $page,
                'baseUrl'    => $request->getBaseUrl(),
                'basePath'   => $request->getBasePath(),
                'listPages'  => $this->listPages
            )
        );
        
        return $content;
    }
    
    public function footerAction(Request $request)
    {
        $page = $request->get('page', '');
        
        $content = $this->render(
            'N9Bundle:Nine:footer.html.twig', 
            array(
                'activePage'    => $page,
                'basePath'      => $request->getBasePath(),
                'listLinks'     => $this->listLinks,
                'listPages'     => $this->listPages
            )
        );
        
        return $content;
    }
    
    public function contactAction(Request $request)
    {
        // Formulaire de contact depuis FormType
        $form = $this->createForm('N9Bundle\Form\ContactType', null, array(
            // To set the action use $this->generateUrl('route_identifier')
            'action' => $this->generateUrl('n9_contact', array(), UrlGeneratorInterface::ABSOLUTE_URL),
            'method' => 'POST'
        ));
        
        return $this->render('N9Bundle:Nine:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function pageAction(Request $request)
    {
        $page = $request->get('page', '');
        $data = array();
        
        switch ($page) {
            case 'experience':
                $repository = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository('N9Bundle:Experience');
                
                $data['listExperiences'] = $repository->getExperiencesWithAll();
            break;
            
            case 'competences':
                $repository = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository('N9Bundle:SkillType');
                $listSkillTypes = $repository->findBy(array(), array('position' => 'ASC'));
                
                $data['listSkillTypes'] = $listSkillTypes;
                
                $repository = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository('N9Bundle:Skill');
                
                $data['listSkills'] = $repository->getSkillsByType();
            break;
                
            case 'formation':
                $repository = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository('N9Bundle:Education');
                
                $data['listEducations'] = $repository->getEducationsWithSchool();
            break;
            
            case 'projets':
                $repository = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository('N9Bundle:Project');
                
                $data['listProjects'] = $repository->findBy(array(), array('year' => 'DESC'));
            break;
                
            case 'photos':
                $repository = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository('N9Bundle:PhotoType');
                
                $listPhotoTypes = $repository->findBy(array(), array('position' => 'ASC'));
                $listPhotos = array();
                
                foreach ($listPhotoTypes as $type) {
                    $listPhotos[$type->getLabel()] = array();
                    
                    $finder = new Finder();
                    $finder->in($this->get('kernel')->getWebDir().'/img/photos/'.$type->getLabel());
                    foreach ($finder as $file) {
                        $listPhotos[$type->getLabel()][] = $file->getFileName();
                    }
                    shuffle($listPhotos[$type->getLabel()]);
                }
                
                $data['listPhotoTypes'] = $listPhotoTypes;
                $data['listPhotos'] = $listPhotos;
            break;
                
            case 'creations':
                $repository = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository('N9Bundle:CreationType');
                
                $listCreationTypes = $repository->findBy(array(), array('position' => 'ASC'));
                $listCreations = array();
                
                foreach ($listCreationTypes as $type) {
                    $listCreations[$type->getLabel()] = array();
                    
                    $finder = new Finder();
                    $finder->in($this->get('kernel')->getWebDir().'/img/creations/'.$type->getLabel());
                    foreach ($finder as $file) {
                        $listCreations[$type->getLabel()][] = $file->getFileName();
                    }
                    shuffle($listCreations[$type->getLabel()]);
                }
                
                $data['listCreationTypes'] = $listCreationTypes;
                $data['listCreations'] = $listCreations;
            break;

            default:
                $page = 'index';
            break;
        }
        
        $data['page'] = $page;
        $data['basePath'] = $request->getBasePath();
        $data['listLibrairies'] = $this->listLibrairies;
        
        $content = $this->render('N9Bundle:Nine:'.$page.'.html.twig', $data);
        
        return $content;
    }
    
    public function sendAction(Request $request) 
    {
        $validator = $this->get('validator');
        
        if ($request->isXmlHttpRequest()) {
            $contact = new Contact();
            $form = $this->createForm(ContactType::class, $contact);
            
            if ($form->handleRequest($request)->isValid()) {
                $contact = $form->getData();
                
                $body = $this->renderView(
                            'N9Bundle:Nine:email.html.twig',
                            array('contact' => $contact)
                );
                $email = \Swift_Message::newInstance();
                $email->setSubject('Nouveau message de carolinenoyer.info')
                    ->setFrom(['smtp@carolinenoyer.info' => "Contact Website"])
                    ->setTo('contact@carolinenoyer.info')
                    ->setBody($body)
                    ->setContentType('text/html');
                $this->get('mailer')->send($email);
                
                //$request->getSession()->getFlashBag()->add('notice', "Votre message a bien été envoyé.");
                
                return new JsonResponse(array(
                    'status'    => 200,
                    'message'   => 'Votre message a bien été envoyé'
                ));
            } else {
                $listErrors = array();
                $listFields = array();
                foreach ($form as $child) {
                    if ($child->getName() != "_token") {
                        foreach ($child->getErrors(true) as $error) {
                            $listErrors[$child->getName()] = $error->getMessage();
                            $listFields[] = $child->getName();
                        }
                    }
                }
                
                $message = "";
                if (count($listErrors) == 1) {
                    $message = "<p><strong>Une erreur a été détectée</strong></p>";
                } else if (count($listErrors) > 1) {
                    $message = "<p><strong>Plusieurs erreurs ont été détectées</strong></p>";
                }
                foreach ($listErrors as $error) {
                    $message .= "<p class=\"mb0\">".$error."</p>";
                }
                
                return new JsonResponse(array(
                    'status'        => 202,
                    'message'       => $message,
                    'listFields'    => $listFields
                ));
            }
        }
        
        return new JsonResponse(array(
            'message'   => 'Un problème technique est survenu. Merci de réessayer ultérieurement.'
        ), 500);
    }
}
