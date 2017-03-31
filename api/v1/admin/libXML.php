<?php
/*
*   Authors: Soteris Demetriou & Katerina Fotiou
*   All rights reserved
*
*   libXML.php : A library file including
*                functions that facilitate
*                the display of data in XML 
*                format.
*/

//////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////// LIBRARY FUNCTIONS /////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////

/*****************************************************************************************************/
/*
* It transforms an array of Persons into XML format and displays it.
* Parameters: $persons: A 2 dimensional array with info for each person
* Return value: None. It displays the information of all Persons in a 
*                     structured XML format.
*/
function constructPersonXMLtree($data,$data2)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <persons>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          
          $xw->text("\n\t\t");
          $xw->startElement('person'); // <person>
          $xw->text("\n\t\t\t");
                $xw->startElement('id');  // <id>
                $xw->text($personData["id"]);
                $xw->endElement();        // </id>
                $xw->text("\n\t\t\t");
                $xw->startElement('name');  // <firstname>
                $xw->text($personData["name"]);
                $xw->endElement();        // </firstname>
                $xw->text("\n\t\t\t");
                $xw->startElement('surname');  // <surname>
                $xw->text($personData["surname"]);
                $xw->endElement();        // </surname>
                $xw->text("\n\t\t\t");
                $xw->startElement('email');  // <email>
                $xw->text($personData["email"]);
                $xw->endElement();        // </email>
                $xw->text("\n\t\t\t");
                $xw->startElement('password');  // <password>
                $xw->text($personData["password"]);
                $xw->endElement();        // </password>
                $xw->text("\n\t\t\t");
                $xw->startElement('dateOfBirth');  // <dateOfBirth>
                $xw->text($personData["dateOfBirth"]);
                $xw->endElement();        // </dateOfBirth>
                $xw->text("\n\t\t\t");
                $xw->startElement('AuthorID');  // <AuthorID>
                $xw->text($personData["AuthorID"]);
                $xw->endElement();        // </AuthorID>
                $xw->text("\n\t\t\t");
                $xw->startElement('UserTypeID');  // <UserTypeID>
                $xw->text($personData["UserTypeID"]);
                $xw->endElement();        // </UserTypeID>
                $xw->text("\n\t\t");
          $xw->endElement();          // </person>
          $xw->text("\n");

      }


}

if (is_array($data2)) {
			$xw->text("\n\t\t");
			$xw->startElement('Privileges'); // <Privileges>

		foreach($data2 as $personNumber2=>$personData2)
		{
		        $xw->text("\n\t\t");
				$xw->startElement('Privilege'); // <Privilege>
				$xw->text("\n\t\t\t");

				$xw->text("\n\t\t\t");
                $xw->startElement('PrivilegeID');  // <PrivilegeID>
                $xw->text($personData2["PrivilegeID"]);
                $xw->endElement();        // </PrivilegeID>
                $xw->text("\n\t\t\t");
                $xw->startElement('PrivilegeName');  // <PrivilegeName>
                $xw->text($personData2["PrivilegeName"]);
                $xw->endElement();        // </PrivilegeName>
                $xw->text("\n\t\t");

				$xw->endElement();          // </Privilege>
				$xw->text("\n");
		}
			$xw->endElement();          // </Privileges>
			$xw->text("\n");

	}
	
	  $xw->endElement();       //  </persons>
      $xw->endDtd();

      print $xw->outputMemory(true);

}
/*****************************************************************************************************/
/*****************************************************************************************************/
/*
* It transforms an array of Questions into XML format and displays it.
* Parameters: $test: A 2 dimensional array with questions for the test
* Return value: None. It displays the information of all questions in a 
*                     structured XML format.
*/

function constructMiniTestXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <persons>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {



          $xw->text("\n\t\t");
          $xw->startElement('Test'); // <person>
          $xw->text("\n\t\t\t");
                $xw->startElement('question');  // <question>
                $xw->text($personData["question"]);
                $xw->endElement();        // </question>
                $xw->text("\n\t\t\t");
                $xw->startElement('correctAnswer');  // <correctAnswer>
                $xw->text($personData["correctAnswer"]);
                $xw->endElement();        // </correctAnswer>
                $xw->text("\n\t\t\t");
                $xw->startElement('questionID');  // <questionID>
                $xw->text($personData["questionID"]);
                $xw->endElement();        // </questionID>
                $xw->text("\n\t\t");
          $xw->endElement();          // </person>
          $xw->text("\n");

      }

      $xw->endElement();       //  </persons>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}

/*****************************************************************************************************/
/*
* It transforms an array of Questions into XML format and displays it.
* Parameters: $test: A 2 dimensional array with questions for the test
* Return value: None. It displays the information of all questions in a 
*                     structured XML format.
*/

function constructMiniTestsXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <persons>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {


          $xw->text("\n\t\t");
          $xw->startElement('Test'); // <Test>
          $xw->text("\n\t\t\t");
                $xw->startElement('TestID');  // <TestID>
                $xw->text($personData["TestID"]);
                $xw->endElement();        // </TestID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Rating');  // <Rating>
                $xw->text($personData["Rating"]);
                $xw->endElement();        // </Rating>
                $xw->text("\n\t\t\t");				
				$xw->startElement('Description');  // <Description>
                $xw->text($personData["Description"]);
                $xw->endElement();        // </Description>
                $xw->text("\n\t\t\t");
				$xw->startElement('Title');  // <Title>
                $xw->text($personData["Title"]);
                $xw->endElement();        // </Title>
                $xw->text("\n\t\t\t");
				$xw->startElement('AuthorName');  // <AuthorID>
                $xw->text($personData["AuthorName"]);
                $xw->endElement();        // </AuthorID>
                $xw->text("\n\t\t\t");
				$xw->startElement('Credits');  // <Credits>
                $xw->text($personData["Credits"]);
                $xw->endElement();        // </Credits>
                $xw->text("\n\t\t");
          $xw->endElement();          // </Test>
          $xw->text("\n");

      }

      $xw->endElement();       //  </persons>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}

function constructUserTypesXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <persons>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('UserType'); // <Usertype>
          $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Description');  // <Description>
                $xw->text($personData["Description"]);
                $xw->endElement();        // </Description>
                $xw->text("\n\t\t\t");
                $xw->startElement('Name');  // <Name>
                $xw->text($personData["Name"]);
                $xw->endElement();        // </Name>
                $xw->text("\n\t\t");
          $xw->endElement();          // </Usertype>
          $xw->text("\n");

      }

      $xw->endElement();       //  </persons>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}

function constructPlansXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <plans>
	  
	if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('Plan'); // <Plan>
          $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Name');  // <Name>
                $xw->text($personData["Name"]);
                $xw->endElement();        // </Name>
                $xw->text("\n\t\t\t");
				$xw->startElement('Euros');  // <Euros>
                $xw->text($personData["Euros"]);
                $xw->endElement();        // </Euros>
                $xw->text("\n\t\t\t");
                $xw->startElement('Credits');  // <Credits>
                $xw->text($personData["Credits"]);
                $xw->endElement();        // </Credits>
                $xw->text("\n\t\t");
          $xw->endElement();          // </Plan>
          $xw->text("\n");

      }

      $xw->endElement();       //  </plans>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}

function constructUserPaymentsXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <userPayments>
	  
	if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('Payment'); // <Payment>
          $xw->text("\n\t\t\t");
                $xw->startElement('Money');  // <Money>
                $xw->text($personData["Money"]);
                $xw->endElement();        // </Money>
                $xw->text("\n\t\t\t");
                $xw->startElement('Credits');  // <Credits>
                $xw->text($personData["Credits"]);
                $xw->endElement();        // </Credits>
                $xw->text("\n\t\t\t");
				$xw->startElement('Date');  // <Date>
                $xw->text($personData["Date"]);
                $xw->endElement();        // </Date>
                $xw->text("\n\t\t");
          $xw->endElement();          // </Payment>
          $xw->text("\n");

      }

      $xw->endElement();       //  </userPayments>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}

function constructTestsWithDetailsXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <Tests>
	  
	if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('Test'); // <Test>
          $xw->text("\n\t\t\t");
                $xw->startElement('TestID');  // <TestID>
                $xw->text($personData["TestID"]);
                $xw->endElement();        // </TestID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Rating');  // <Rating>
                $xw->text($personData["Rating"]);
                $xw->endElement();        // </Rating>
                $xw->text("\n\t\t\t");
				$xw->startElement('Description');  // <Description>
                $xw->text($personData["Description"]);
                $xw->endElement();        // </Description>
                $xw->text("\n\t\t\t");
				$xw->startElement('Title');  // <Title>
                $xw->text($personData["Title"]);
                $xw->endElement();        // </Title>
                $xw->text("\n\t\t\t");
				$xw->startElement('AuthorName');  // <AuthorName>
                $xw->text($personData["AuthorName"]);
                $xw->endElement();        // </AuthorName>
                $xw->text("\n\t\t\t");
				$xw->startElement('Credits');  // <Credits>
                $xw->text($personData["Credits"]);
                $xw->endElement();        // </Credits>
                $xw->text("\n\t\t\t");
				$xw->startElement('TypeMorL');  // <TypeMorL>
                $xw->text($personData["TypeMorL"]);
                $xw->endElement();        // </TypeMorL>
                $xw->text("\n\t\t\t");
				$xw->startElement('SubjectName');  // <SubjectName>
                $xw->text($personData["SubjectName"]);
                $xw->endElement();        // </SubjectName>
                $xw->text("\n\t\t");
          $xw->endElement();          // </Test>
          $xw->text("\n");

      }

      $xw->endElement();       //  </Tests>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}

function constructTestsTakenXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <TestsTaken>
	  
	if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('TestTaken'); // <TestTaken>
          $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
				$xw->startElement('Title');  // <Title>
                $xw->text($personData["Title"]);
                $xw->endElement();        // </Title>
                $xw->text("\n\t\t\t");
				$xw->startElement('Credits');  // <Credits>
                $xw->text($personData["Credits"]);
                $xw->endElement();        // </Credits>
                $xw->text("\n\t\t\t");
				$xw->startElement('Status');  // <Status>
                $xw->text($personData["Status"]);
                $xw->endElement();        // </Status>
                $xw->text("\n\t\t\t");
				$xw->startElement('DateStarted');  // <DateStarted>
                $xw->text($personData["DateStarted"]);
                $xw->endElement();        // </DateStarted>
                $xw->text("\n\t\t");
          $xw->endElement();          // </TestTaken>
          $xw->text("\n");

      }

      $xw->endElement();       //  </TestsTaken>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}


function constructQuestionsOfMiniTestXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <persons>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('Test'); // <Test>
          $xw->text("\n\t\t\t");
                $xw->startElement('question');  // <question>
                $xw->text($personData["question"]);
                $xw->endElement();        // </question>
                $xw->text("\n\t\t\t");
                $xw->startElement('correctAnswer');  // <correctAnswer>
                $xw->text($personData["correctAnswer"]);
                $xw->endElement();        // </correctAnswer>
                $xw->text("\n\t\t\t");
                $xw->startElement('questionID');  // <questionID>
                $xw->text($personData["questionID"]);
                $xw->endElement();        // </questionID>
		$xw->text("\n\t\t\t");
                $xw->startElement('QuestionTypeID');  // <QuestionTypeID>
                $xw->text($personData["QuestionTypeID"]);
                $xw->endElement();        // </QuestionTypeID>
		$xw->text("\n\t\t\t");
                $xw->startElement('w1');  // <w1>
                $xw->text($personData["w1"]);
                $xw->endElement();        // </w1>
		$xw->text("\n\t\t\t");
                $xw->startElement('w2');  // <w2>
                $xw->text($personData["w2"]);
                $xw->endElement();        // </w2>
		$xw->text("\n\t\t\t");
                $xw->startElement('w3');  // <w3>
                $xw->text($personData["w3"]);
                $xw->endElement();        // </w3>
		$xw->text("\n\t\t\t");
                $xw->startElement('PosInTest');  // <PosInTest>
                $xw->text($personData["PosInTest"]);
                $xw->endElement();        // </PosInTest>
                $xw->text("\n\t\t");
          $xw->endElement();          // </Test>
          $xw->text("\n");

      }

      $xw->endElement();       //  </persons>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}
/****************************************************************
* Function that creates an XML Tree with all the question types
* Output: QuestionTypeID, Name, Description
*****************************************************************/
function constructQuestionTypesXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <persons>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('QuestionType'); // <QuestionType>
          $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Description');  // <Description>
                $xw->text($personData["Description"]);
                $xw->endElement();        // </Description>
                $xw->text("\n\t\t\t");
                $xw->startElement('Name');  // <Name>
                $xw->text($personData["Name"]);
                $xw->endElement();        // </Name>
                $xw->text("\n\t\t");
          $xw->endElement();          // </QuestionType>
          $xw->text("\n");

      }

      $xw->endElement();       //  </persons>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}
/****************************************************************
* Function that creates an XML Tree with all the Subjects
* Output: subjectID, Name, Description
*****************************************************************/
function constructSubjectsXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <subjects>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('Subject'); // <Subject>
          $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Description');  // <Description>
                $xw->text($personData["Description"]);
                $xw->endElement();        // </Description>
                $xw->text("\n\t\t\t");
                $xw->startElement('Name');  // <Name>
                $xw->text($personData["Name"]);
                $xw->endElement();        // </Name>
                $xw->text("\n\t\t");
          $xw->endElement();          // </Subject>
          $xw->text("\n");

      }

      $xw->endElement();       //  </subjects>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}

/****************************************************************
* Function that creates an XML Tree with all the Sub - Subjects
* Output: subjectID, subsubjectID, Name, Description
*****************************************************************/
function constructSubsubjectsXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <subjects>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('SubSubject'); // <SubSubject>
          $xw->text("\n\t\t\t");
		$xw->startElement('SubjectName');  // <SubjectName>
                $xw->text($personData["SubjectName"]);
                $xw->endElement();        // </SubjectName>
                $xw->text("\n\t\t\t");
		$xw->startElement('SubjectID');  // <SubjectID>
                $xw->text($personData["SubjectID"]);
                $xw->endElement();        // </SubjectID>
                $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Description');  // <Description>
                $xw->text($personData["Description"]);
                $xw->endElement();        // </Description>
                $xw->text("\n\t\t\t");
                $xw->startElement('Name');  // <Name>
                $xw->text($personData["Name"]);
                $xw->endElement();        // </Name>
                $xw->text("\n\t\t");
          $xw->endElement();          // </Subject>
          $xw->text("\n");

      }

      $xw->endElement();       //  </subjects>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}

/****************************************************************
* Function that creates an XML Tree with all the Classes
* Output: classesID, Name, Description
*****************************************************************/
function constructClassesXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <persons>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('Class'); // <Class>
          $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Description');  // <Description>
                $xw->text($personData["Description"]);
                $xw->endElement();        // </Description>
                $xw->text("\n\t\t\t");
                $xw->startElement('Name');  // <Name>
                $xw->text($personData["Name"]);
                $xw->endElement();        // </Name>
                $xw->text("\n\t\t");
          $xw->endElement();          // </Class>
          $xw->text("\n");

      }

      $xw->endElement();       //  </persons>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}

/****************************************************************
* Function that creates an XML Tree with all the Sub - Subjects
* Output: subjectID, subsubjectID, Name, Description
*****************************************************************/
function constructSubSubSubXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <subjects>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('SubSubject'); // <SubSubject>
          $xw->text("\n\t\t\t");
		        $xw->startElement('SubjectName');  // <SubjectName>
                $xw->text($personData["SubjectName"]);
                $xw->endElement();        // </SubjectName>
                $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Description');  // <Description>
                $xw->text($personData["Description"]);
                $xw->endElement();        // </Description>
                $xw->text("\n\t\t\t");
                $xw->startElement('Name');  // <Name>
                $xw->text($personData["Name"]);
                $xw->endElement();        // </Name>
                $xw->text("\n\t\t");
          $xw->endElement();          // </Subject>
          $xw->text("\n");

      }

      $xw->endElement();       //  </subjects>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}
/*****************************************************************************************************/
/*
* It transforms an array of Questions into XML format and displays it.
* Parameters: $questions: A 2 dimensional array with questiondetails
* Return value: None. It displays the information of all questions in a 
*                     structured XML format.
*/

function constructQuestionDetailsXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <questions>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {



          $xw->text("\n\t\t");
          $xw->startElement('QuestionDetails'); // <QuestionDetails>
          $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Difficulty');  // <Difficulty>
                $xw->text($personData["Difficulty"]);
                $xw->endElement();        // </Difficulty>
                $xw->text("\n\t\t\t");
                $xw->startElement('QuestionTypeID');  // <QuestionTypeID>
                $xw->text($personData["QuestionTypeID"]);
                $xw->endElement();        // </QuestionTypeID>
                $xw->text("\n\t\t\t");
                $xw->startElement('ClassID');  // <ClassID>
                $xw->text($personData["ClassID"]);
                $xw->endElement();        // </ClassID>
                $xw->text("\n\t\t\t");
                $xw->startElement('SubjectID');  // <SubjectID>
                $xw->text($personData["SubjectID"]);
                $xw->endElement();        // </SubjectID>
                $xw->text("\n\t\t\t");
                $xw->startElement('SubsubjectID');  // <SubsubjectID>
                $xw->text($personData["SubsubjectID"]);
                $xw->endElement();        // </SubsubjectID>
                $xw->text("\n\t\t\t");
                $xw->startElement('AuthorID');  // <AuthorID>
                $xw->text($personData["AuthorID"]);
                $xw->endElement();        // </AuthorID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Visible');  // <Visible>
                $xw->text($personData["Visible"]);
                $xw->endElement();        // </Visible>
                $xw->text("\n\t\t\t");
                $xw->startElement('Source');  // <Source>
                $xw->text($personData["Source"]);
                $xw->endElement();        // </Source>
                $xw->text("\n\t\t\t");
                $xw->startElement('Link');  // <Link>
                $xw->text($personData["Link"]);
                $xw->endElement();        // </Link>
                $xw->text("\n\t\t\t");
                $xw->startElement('Question');  // <Question>
                $xw->text($personData["Question"]);
                $xw->endElement();        // </Question>
                $xw->text("\n\t\t\t");
                $xw->startElement('correctAnswer');  // <correctAnswer>
                $xw->text($personData["correctAnswer"]);
                $xw->endElement();        // </correctAnswer>
                $xw->text("\n\t\t\t");
                $xw->startElement('w1');  // <w1>
                $xw->text($personData["w1"]);
                $xw->endElement();        // </w1>
                $xw->text("\n\t\t\t");
                $xw->startElement('w2');  // <w2>
                $xw->text($personData["w2"]);
                $xw->endElement();        // </w2>
                $xw->text("\n\t\t\t");
                $xw->startElement('w3');  // <w3>
                $xw->text($personData["w3"]);
                $xw->endElement();        // </w3>
                $xw->text("\n\t\t");
          $xw->endElement();          // </QuestionDetails>
          $xw->text("\n");

      }

      $xw->endElement();       //  </questions>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}


/****************************************************************
* Function that creates an XML Tree with all the minitests of biology test 1
* Output:  Title, TestID
*****************************************************************/
function constructSBiologyTestsXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <persons>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('minitests'); // <minitests>
          $xw->text("\n\t\t\t");
                $xw->startElement('Title');  // <Title>
                $xw->text($personData["Title"]);
                $xw->endElement();        // </Title>
                $xw->text("\n\t\t\t");
                 $xw->startElement('TestID');  // <TestID>
                $xw->text($personData["TestID"]);
                $xw->endElement();        // </TestID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Rating');  // <Rating>
                $xw->text($personData["Rating"]);
                $xw->endElement();        // </Rating>
                $xw->text("\n\t\t");
          $xw->endElement();          // </minitests>
          $xw->text("\n");

      }

      $xw->endElement();       //  </persons>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}



/****************************************************************
* Function that creates an XML Tree with all the minitests of biology test 1
* Output:  Title, TestID
*****************************************************************/
function constructTestProgressXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <persons>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('minitests'); // <minitests>
          $xw->text("\n\t\t\t");
                $xw->startElement('TestID');  // <TestID>
                $xw->text($personData["TestID"]);
                $xw->endElement();        // </TestID>
                $xw->text("\n\t\t\t");
                $xw->startElement('MaxStatus');  // <MaxStatus>
                $xw->text($personData["MaxStatus"]);
                $xw->endElement();        // </MaxStatus>
                $xw->text("\n\t\t\t");
                $xw->startElement('MaxScore');  // <MaxScore>
                $xw->text($personData["MaxScore"]);
                $xw->endElement();        // </MaxScore>
                $xw->text("\n\t\t\t");
                $xw->startElement('Title');  // <Title>
                $xw->text($personData["Title"]);
                $xw->endElement();        // </Title>
                $xw->text("\n\t\t");
          $xw->endElement();          // </minitests>
          $xw->text("\n");

      }

      $xw->endElement();       //  </persons>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}


/****************************************************************
* Function that creates an XML Tree with all the minitests of biology test 1
* Output:  Title, TestID
*****************************************************************/
function constructTestProgressDetailsXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <persons>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('Progress'); // <Progress>
          $xw->text("\n\t\t\t");
                $xw->startElement('Title');  // <Title>
                $xw->text($personData["Title"]);
                $xw->endElement();        // </Title>
                $xw->text("\n\t\t\t");
                $xw->startElement('DateStarted');  // <DateStarted>
                $xw->text($personData["DateStarted"]);
                $xw->endElement();        // </DateStarted>
                $xw->text("\n\t\t\t");
                $xw->startElement('TotalTime');  // <TotalTime>
                $xw->text($personData["TotalTime"]);
                $xw->endElement();        // </TotalTime>
                $xw->text("\n\t\t\t");
                $xw->startElement('Score');  // <Score>
                $xw->text($personData["Score"]);
                $xw->endElement();        // </Score>
                $xw->text("\n\t\t");
          $xw->endElement();          // </Progress>
          $xw->text("\n");

      }

      $xw->endElement();       //  </persons>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}





/****************************************************************
* Function that creates an XML Tree with all the minitests of biology test 1
* Output:  Title, TestID
*****************************************************************/
function constructFirstProgressXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <persons>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {
          $xw->text("\n\t\t");
          $xw->startElement('progress'); // <progress>
          $xw->text("\n\t\t\t");
                $xw->startElement('TestID');  // <TestID>
                $xw->text($personData["TestID"]);
                $xw->endElement();        // </TestID>
                $xw->text("\n\t\t\t");
                $xw->startElement('currentTestTakenID');  // <currentTestTakenID>
                $xw->text($personData["currentTestTakenID"]);
                $xw->endElement();        // </currentTestTakenID>
                $xw->text("\n\t\t\t");
                $xw->startElement('currentPosition');  // <currentPosition>
                $xw->text($personData["currentPosition"]);
                $xw->endElement();        // </currentPosition>
                $xw->text("\n\t\t\t");
                $xw->startElement('corrects');  // <corrects>
                $xw->text($personData["corrects"]);
                $xw->endElement();        // </corrects>
                $xw->text("\n\t\t\t");
                $xw->startElement('wrongs');  // <wrongs>
                $xw->text($personData["wrongs"]);
                $xw->endElement();        // </wrongs>
                $xw->text("\n\t\t\t");
                $xw->startElement('timeElapsed');  // <timeElapsed>
                $xw->text($personData["timeElapsed"]);
                $xw->endElement();        // </timeElapsed>
                $xw->text("\n\t\t");
          $xw->endElement();          // </progress>
          $xw->text("\n");

      }

      $xw->endElement();       //  </persons>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}

function constructQuestionsXMLtree($data,$data2)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <questions>
	if (is_array($data)) {
		foreach($data as $personNumber=>$personData)
		{

			$xw->text("\n\t\t");
			$xw->startElement('QuestionData'); // <QuestionData>
			$xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Difficulty');  // <Difficulty>
                $xw->text($personData["Difficulty"]);
                $xw->endElement();        // </Difficulty>
                $xw->text("\n\t\t\t");
                $xw->startElement('QTID');  // <QTID>
                $xw->text($personData["QTID"]);
                $xw->endElement();        // </QTID>
                $xw->text("\n\t\t\t");
                $xw->startElement('ClassID');  // <ClassID>
                $xw->text($personData["ClassID"]);
                $xw->endElement();        // </ClassID>
                $xw->text("\n\t\t\t");
                $xw->startElement('SubjectID');  // <SubjectID>
                $xw->text($personData["SubjectID"]);
                $xw->endElement();        // </SubjectID>
                $xw->text("\n\t\t\t");
                $xw->startElement('SubsubjectID');  // <SubsubjectID>
                $xw->text($personData["SubsubjectID"]);
                $xw->endElement();        // </SubsubjectID>
                $xw->text("\n\t\t\t");
                $xw->startElement('AuthorID');  // <AuthorID>
                $xw->text($personData["AuthorID"]);
                $xw->endElement();        // </AuthorID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Source');  // <Source>
                $xw->text($personData["Source"]);
                $xw->endElement();        // </Source>
                $xw->text("\n\t\t\t");
                $xw->startElement('Link');  // <Link>
                $xw->text($personData["Link"]);
                $xw->endElement();        // </Link>
                $xw->text("\n\t\t\t");
                $xw->startElement('Approved');  // <Approved>
                $xw->text($personData["Approved"]);
                $xw->endElement();        // </Approved>
                $xw->text("\n\t\t\t");
                $xw->startElement('Question');  // <Question>
                $xw->text($personData["Question"]);
                $xw->endElement();        // </Question>
                $xw->text("\n\t\t\t");
                $xw->startElement('CorrectA');  // <CorrectA>
                $xw->text($personData["CorrectA"]);
                $xw->endElement();        // </CorrectA>
                $xw->text("\n\t\t\t");
                $xw->startElement('HintTrue');  // <HintTrue>
                $xw->text($personData["HintTrue"]);
                $xw->endElement();        // </HintTrue>
                $xw->text("\n\t\t\t");
                $xw->startElement('HintFalse');  // <HintFalse>
                $xw->text($personData["HintFalse"]);
                $xw->endElement();        // </HintFalse>
                $xw->text("\n\t\t\t");
                $xw->startElement('Wrong1');  // <Wrong1>
                $xw->text($personData["Wrong1"]);
                $xw->endElement();        // </Wrong1>
                $xw->text("\n\t\t\t");
                $xw->startElement('Wrong2');  // <Wrong2>
                $xw->text($personData["Wrong2"]);
                $xw->endElement();        // </Wrong2>
                $xw->text("\n\t\t\t");
                $xw->startElement('Wrong3');  // <Wrong3>
                $xw->text($personData["Wrong3"]);
                $xw->endElement();        // </Wrong3>
                $xw->text("\n\t\t\t");
                $xw->startElement('HintCorrect');  // <HintCorrect>
                $xw->text($personData["HintCorrect"]);
                $xw->endElement();        // </HintCorrect>
                $xw->text("\n\t\t\t");
                $xw->startElement('HintWrong1');  // <HintWrong1>
                $xw->text($personData["HintWrong1"]);
                $xw->endElement();        // </HintWrong1>
                $xw->text("\n\t\t\t");
                $xw->startElement('HintWrong2');  // <HintWrong2>
                $xw->text($personData["HintWrong2"]);
                $xw->endElement();        // </HintWrong2>
				$xw->text("\n\t\t\t");
                $xw->startElement('HintWrong3');  // <HintWrong3>
                $xw->text($personData["HintWrong3"]);
                $xw->endElement();        // </HintWrong3>
                $xw->text("\n\t\t\t");
                $xw->startElement('QuestionPic');  // <QuestionPic>
                $xw->text($personData["QuestionPic"]);
                $xw->endElement();        // </QuestionPic>

                $xw->text("\n\t\t");
			$xw->endElement();          // </QuestionData>
			$xw->text("\n");

		}



	}
	if (is_array($data2)) {
		foreach($data2 as $personNumber2=>$personData2)
		{

			$xw->text("\n\t\t");
			$xw->startElement('QuestionT6Data'); // <QuestionT6Data>
			$xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData2["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Difficulty');  // <Difficulty>
                $xw->text($personData2["Difficulty"]);
                $xw->endElement();        // </Difficulty>
                $xw->text("\n\t\t\t");
                $xw->startElement('QTID');  // <QTID>
                $xw->text($personData2["QTID"]);
                $xw->endElement();        // </QTID>
                $xw->text("\n\t\t\t");
                $xw->startElement('ClassID');  // <ClassID>
                $xw->text($personData2["ClassID"]);
                $xw->endElement();        // </ClassID>
                $xw->text("\n\t\t\t");
                $xw->startElement('SubjectID');  // <SubjectID>
                $xw->text($personData2["SubjectID"]);
                $xw->endElement();        // </SubjectID>
                $xw->text("\n\t\t\t");
                $xw->startElement('SubsubjectID');  // <SubsubjectID>
                $xw->text($personData2["SubsubjectID"]);
                $xw->endElement();        // </SubsubjectID>
                $xw->text("\n\t\t\t");
                $xw->startElement('AuthorID');  // <AuthorID>
                $xw->text($personData2["AuthorID"]);
                $xw->endElement();        // </AuthorID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Source');  // <Source>
                $xw->text($personData2["Source"]);
                $xw->endElement();        // </Source>
                $xw->text("\n\t\t\t");
                $xw->startElement('Link');  // <Link>
                $xw->text($personData2["Link"]);
                $xw->endElement();        // </Link>
                $xw->text("\n\t\t\t");
                $xw->startElement('Approved');  // <Approved>
                $xw->text($personData2["Approved"]);
                $xw->endElement();        // </Approved>
                $xw->text("\n\t\t\t");
                $xw->startElement('Question');  // <Question>
                $xw->text($personData2["Question"]);
                $xw->endElement();        // </Question>
                $xw->text("\n\t\t\t");
                $xw->startElement('Answer');  // <Answer>
                $xw->text($personData2["Answer"]);
                $xw->endElement();        // </Answer>
				$xw->text("\n\t\t\t");
                $xw->startElement('Hint');  // <Hint>
                $xw->text($personData2["Hint"]);
                $xw->endElement();        // </Hint>
				$xw->text("\n\t\t\t");
                $xw->startElement('Correct');  // <Correct>
                $xw->text($personData2["Correct"]);
                $xw->endElement();        // </Correct>
                $xw->text("\n\t\t");
			$xw->endElement();          // </QuestionT6Data>
			$xw->text("\n");

		}


	}
	      $xw->endElement();       //  </questions>
    $xw->endDtd();

    print $xw->outputMemory(true);
}


/*****************************************************************************************************/
/*
* It transforms an array of Questions into XML format and displays it.
* Parameters: $test: A 2 dimensional array with questions for the test
* Return value: None. It displays the information of all questions in a 
*                     structured XML format.
*/

function constructAuthorXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <persons>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {



          $xw->text("\n\t\t");
          $xw->startElement('Author'); // <Author>
          $xw->text("\n\t\t\t");
                $xw->startElement('Name');  // <Name>
                $xw->text($personData["Name"]);
                $xw->endElement();        // </Name>
                $xw->text("\n\t\t\t");
                $xw->startElement('Surname');  // <Surname>
                $xw->text($personData["Surname"]);
                $xw->endElement();        // </Surname>
                $xw->text("\n\t\t\t");
                $xw->startElement('Nickname');  // <Nickname>
                $xw->text($personData["Nickname"]);
                $xw->endElement();        // </Nickname>
                $xw->text("\n\t\t\t");
                $xw->startElement('DateOfBirth');  // <DateOfBirth>
                $xw->text($personData["DateOfBirth"]);
                $xw->endElement();        // </DateOfBirth>
                $xw->text("\n\t\t\t");
                $xw->startElement('Profession');  // <Profession>
                $xw->text($personData["Profession"]);
                $xw->endElement();        // </Profession>
                $xw->text("\n\t\t");
          $xw->endElement();          // </person>
          $xw->text("\n");

      }

      $xw->endElement();       //  </Author>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}




/*****************************************************************************************************/
/*
* It transforms an array of Questions into XML format and displays it.
* Parameters: $test: A 2 dimensional array with questions for the test
* Return value: None. It displays the information of all questions in a 
*                     structured XML format.
*/

function constructSubjectRequestsXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <Requests>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {



          $xw->text("\n\t\t");
          $xw->startElement('SubjectRequest'); // <SubjectRequest>
          $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Nickname');  // <Nickname>
                $xw->text($personData["Nickname"]);
                $xw->endElement();        // </Nickname>
                $xw->text("\n\t\t\t");
                $xw->startElement('AuthorID');  // <AuthorID>
                $xw->text($personData["AuthorID"]);
                $xw->endElement();        // </AuthorID>
                $xw->text("\n\t\t\t");
                $xw->startElement('SubjectName');  // <SubjectName>
                $xw->text($personData["SubjectName"]);
                $xw->endElement();        // </SubjectName>
                $xw->text("\n\t\t\t");
                $xw->startElement('SubjectID');  // <SubjectID>
                $xw->text($personData["SubjectID"]);
                $xw->endElement();        // </SubjectID>
                $xw->text("\n\t\t\t");
                $xw->startElement('DateRequested');  // <DateRequested>
                $xw->text($personData["DateRequested"]);
                $xw->endElement();        // </DateRequested>
                $xw->text("\n\t\t\t");
                $xw->startElement('Status');  // <Status>
                $xw->text($personData["Status"]);
                $xw->endElement();        // </Status>
                $xw->text("\n\t\t");
          $xw->endElement();          // </SubjectRequest>
          $xw->text("\n");

      }

      $xw->endElement();       //  </Requests>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}




function constructRoleRequestsXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <RoleRequests>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {



          $xw->text("\n\t\t");
          $xw->startElement('RoleRequest'); // <RoleRequest>
          $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Nickname');  // <Nickname>
                $xw->text($personData["Nickname"]);
                $xw->endElement();        // </Nickname>
                $xw->text("\n\t\t\t");
                $xw->startElement('AuthorID');  // <AuthorID>
                $xw->text($personData["AuthorID"]);
                $xw->endElement();        // </AuthorID>
                $xw->text("\n\t\t\t");
                $xw->startElement('RoleName');  // <RoleName>
                $xw->text($personData["RoleName"]);
                $xw->endElement();        // </RoleName>
                $xw->text("\n\t\t\t");
                $xw->startElement('RoleID');  // <RoleID>
                $xw->text($personData["RoleID"]);
                $xw->endElement();        // </RoleID>
                $xw->text("\n\t\t\t");
                $xw->startElement('DateRequested');  // <DateRequested>
                $xw->text($personData["DateRequested"]);
                $xw->endElement();        // </DateRequested>
                $xw->text("\n\t\t\t");
                $xw->startElement('Status');  // <Status>
                $xw->text($personData["Status"]);
                $xw->endElement();        // </Status>
                $xw->text("\n\t\t");
          $xw->endElement();          // </RoleRequest>
          $xw->text("\n");

      }

      $xw->endElement();       //  </RoleRequests>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}




function constructRolesXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <Roles>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {



          $xw->text("\n\t\t");
          $xw->startElement('Role'); // <Role>
          $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Name');  // <Name>
                $xw->text($personData["Name"]);
                $xw->endElement();        // </Name>
                $xw->text("\n\t\t");
          $xw->endElement();          // </Role>
          $xw->text("\n");

      }

      $xw->endElement();       //  </Roles>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}


function constructFeedbackTypesXMLtree($data)
{   

      $xw = new xmlWriter();
      $xw->openMemory();

      $xw->startDocument('1.0','UTF-8');
      $xw->startElement('data'); // <feedbacks>
if (is_array($data)) {
      foreach($data as $personNumber=>$personData)
      {



          $xw->text("\n\t\t");
          $xw->startElement('Feedback'); // <feedback>
          $xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Name');  // <Name>
                $xw->text($personData["Name"]);
                $xw->endElement();        // </Name>
                $xw->text("\n\t\t\t");
                $xw->startElement('Description');  // <Description>
                $xw->text($personData["Description"]);
                $xw->endElement();        // </Description>
                $xw->text("\n\t\t");
          $xw->endElement();          // </feedback>
          $xw->text("\n");

      }

      $xw->endElement();       //  </feedbacks>
      $xw->endDtd();

      print $xw->outputMemory(true);
}

}


/***/


function openXMLWriter()
{
	$xw = new xmlWriter();
    $xw->openMemory();

    $xw->startDocument('1.0','UTF-8');
    $xw->startElement('data'); // <questions>
	
	return $xw;
	
}

function writeType1XML($xw,$data)
{

	if (is_array($data))
	{
		foreach($data as $personNumber=>$personData)
		{
			$xw->text("\n\t\t");
			$xw->startElement('Type1'); // <Type1>
			$xw->text("\n\t\t\t");
			$xw->startElement('ID');  // <ID>
			$xw->text($personData["ID"]);
			$xw->endElement();        // </ID>
			$xw->text("\n\t\t\t");
            $xw->startElement('Difficulty');  // <Difficulty>
            $xw->text($personData["Difficulty"]);
            $xw->endElement();        // </Difficulty>
            $xw->text("\n\t\t\t");
            $xw->startElement('ClassID');  // <ClassID>
            $xw->text($personData["ClassID"]);
            $xw->endElement();        // </ClassID>
            $xw->text("\n\t\t\t");
            $xw->startElement('SubjectID');  // <SubjectID>
            $xw->text($personData["SubjectID"]);
            $xw->endElement();        // </SubjectID>
            $xw->text("\n\t\t\t");
            $xw->startElement('SubsubjectID');  // <SubsubjectID>
            $xw->text($personData["SubsubjectID"]);
            $xw->endElement();        // </SubsubjectID>
            $xw->text("\n\t\t\t");
            $xw->startElement('AuthorID');  // <AuthorID>
            $xw->text($personData["AuthorID"]);
            $xw->endElement();        // </AuthorID>
            $xw->text("\n\t\t\t");
            $xw->startElement('Source');  // <Source>
            $xw->text($personData["Source"]);
            $xw->endElement();        // </Source>
            $xw->text("\n\t\t\t");
            $xw->startElement('Link');  // <Link>
            $xw->text($personData["Link"]);
            $xw->endElement();        // </Link>
            $xw->text("\n\t\t\t");
            $xw->startElement('Approved');  // <Approved>
            $xw->text($personData["Approved"]);
            $xw->endElement();        // </Approved>
            $xw->text("\n\t\t\t");
            $xw->startElement('Question');  // <Question>
            $xw->text($personData["Question"]);
            $xw->endElement();        // </Question>
            $xw->text("\n\t\t\t");
            $xw->startElement('CorrectA');  // <CorrectA>
            $xw->text($personData["CorrectA"]);
            $xw->endElement();        // </CorrectA>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintTrue');  // <HintTrue>
            $xw->text($personData["HintTrue"]);
            $xw->endElement();        // </HintTrue>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintFalse');  // <HintFalse>
            $xw->text($personData["HintFalse"]);
            $xw->endElement();        // </HintFalse>
            $xw->text("\n\t\t\t");

			$xw->text("\n\t\t");
			$xw->endElement();          // </Type1>
			$xw->text("\n");
		}
	}

}

function writeType3XML($xw,$data)
{

	if (is_array($data))
	{
		foreach($data as $personNumber=>$personData)
		{
			$xw->text("\n\t\t");
			$xw->startElement('Type3'); // <Type3>
			$xw->text("\n\t\t\t");
			$xw->startElement('ID');  // <ID>
			$xw->text($personData["ID"]);
			$xw->endElement();        // </ID>
			$xw->text("\n\t\t\t");
            $xw->startElement('Difficulty');  // <Difficulty>
            $xw->text($personData["Difficulty"]);
            $xw->endElement();        // </Difficulty>
            $xw->text("\n\t\t\t");
            $xw->startElement('ClassID');  // <ClassID>
            $xw->text($personData["ClassID"]);
            $xw->endElement();        // </ClassID>
            $xw->text("\n\t\t\t");
            $xw->startElement('SubjectID');  // <SubjectID>
            $xw->text($personData["SubjectID"]);
            $xw->endElement();        // </SubjectID>
            $xw->text("\n\t\t\t");
            $xw->startElement('SubsubjectID');  // <SubsubjectID>
            $xw->text($personData["SubsubjectID"]);
            $xw->endElement();        // </SubsubjectID>
            $xw->text("\n\t\t\t");
            $xw->startElement('AuthorID');  // <AuthorID>
            $xw->text($personData["AuthorID"]);
            $xw->endElement();        // </AuthorID>
            $xw->text("\n\t\t\t");
            $xw->startElement('Source');  // <Source>
            $xw->text($personData["Source"]);
            $xw->endElement();        // </Source>
            $xw->text("\n\t\t\t");
            $xw->startElement('Link');  // <Link>
            $xw->text($personData["Link"]);
            $xw->endElement();        // </Link>
            $xw->text("\n\t\t\t");
            $xw->startElement('Approved');  // <Approved>
            $xw->text($personData["Approved"]);
            $xw->endElement();        // </Approved>
            $xw->text("\n\t\t\t");
            $xw->startElement('Question');  // <Question>
            $xw->text($personData["Question"]);
            $xw->endElement();        // </Question>
            $xw->text("\n\t\t\t");
            $xw->startElement('CorrectA');  // <CorrectA>
            $xw->text($personData["CorrectA"]);
            $xw->endElement();        // </CorrectA>
            $xw->text("\n\t\t\t");
            $xw->startElement('Wrong1');  // <Wrong1>
            $xw->text($personData["Wrong1"]);
            $xw->endElement();        // </Wrong1>
            $xw->text("\n\t\t\t");
            $xw->startElement('Wrong2');  // <Wrong2>
            $xw->text($personData["Wrong2"]);
            $xw->endElement();        // </Wrong2>
            $xw->text("\n\t\t\t");
            $xw->startElement('Wrong3');  // <Wrong3>
            $xw->text($personData["Wrong3"]);
            $xw->endElement();        // </Wrong3>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintCorrect');  // <HintCorrect>
            $xw->text($personData["HintCorrect"]);
            $xw->endElement();        // </HintCorrect>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintWrong1');  // <HintWrong1>
            $xw->text($personData["HintWrong1"]);
            $xw->endElement();        // </HintWrong1>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintWrong2');  // <HintWrong2>
            $xw->text($personData["HintWrong2"]);
            $xw->endElement();        // </HintWrong2>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintWrong3');  // <HintWrong3>
            $xw->text($personData["HintWrong3"]);
            $xw->endElement();        // </HintWrong3>
            $xw->text("\n\t\t\t");

			$xw->endElement();          // </Type3>
			$xw->text("\n");
		}
	}

}


function writeType8XML($xw,$data)
{

	if (is_array($data))
	{
		foreach($data as $personNumber=>$personData)
		{
			$xw->text("\n\t\t");
			$xw->startElement('Type8'); // <Type8>
			$xw->text("\n\t\t\t");
			$xw->startElement('ID');  // <ID>
			$xw->text($personData["ID"]);
			$xw->endElement();        // </ID>
			$xw->text("\n\t\t\t");
            $xw->startElement('Difficulty');  // <Difficulty>
            $xw->text($personData["Difficulty"]);
            $xw->endElement();        // </Difficulty>
            $xw->text("\n\t\t\t");
            $xw->startElement('ClassID');  // <ClassID>
            $xw->text($personData["ClassID"]);
            $xw->endElement();        // </ClassID>
            $xw->text("\n\t\t\t");
            $xw->startElement('SubjectID');  // <SubjectID>
            $xw->text($personData["SubjectID"]);
            $xw->endElement();        // </SubjectID>
            $xw->text("\n\t\t\t");
            $xw->startElement('SubsubjectID');  // <SubsubjectID>
            $xw->text($personData["SubsubjectID"]);
            $xw->endElement();        // </SubsubjectID>
            $xw->text("\n\t\t\t");
            $xw->startElement('AuthorID');  // <AuthorID>
            $xw->text($personData["AuthorID"]);
            $xw->endElement();        // </AuthorID>
            $xw->text("\n\t\t\t");
            $xw->startElement('Source');  // <Source>
            $xw->text($personData["Source"]);
            $xw->endElement();        // </Source>
            $xw->text("\n\t\t\t");
            $xw->startElement('Link');  // <Link>
            $xw->text($personData["Link"]);
            $xw->endElement();        // </Link>
            $xw->text("\n\t\t\t");
            $xw->startElement('Approved');  // <Approved>
            $xw->text($personData["Approved"]);
            $xw->endElement();        // </Approved>
            $xw->text("\n\t\t\t");
            $xw->startElement('Question');  // <Question>
            $xw->text($personData["Question"]);
            $xw->endElement();        // </Question>
            $xw->text("\n\t\t\t");
            $xw->startElement('QuestionPic');  // <QuestionPic>
            $xw->text($personData["QuestionPic"]);
            $xw->endElement();        // </QuestionPic>
            $xw->text("\n\t\t\t");
            $xw->startElement('CorrectA');  // <CorrectA>
            $xw->text($personData["CorrectA"]);
            $xw->endElement();        // </CorrectA>
            $xw->text("\n\t\t\t");
            $xw->startElement('Wrong1');  // <Wrong1>
            $xw->text($personData["Wrong1"]);
            $xw->endElement();        // </Wrong1>
            $xw->text("\n\t\t\t");
            $xw->startElement('Wrong2');  // <Wrong2>
            $xw->text($personData["Wrong2"]);
            $xw->endElement();        // </Wrong2>
            $xw->text("\n\t\t\t");
            $xw->startElement('Wrong3');  // <Wrong3>
            $xw->text($personData["Wrong3"]);
            $xw->endElement();        // </Wrong3>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintCorrect');  // <HintCorrect>
            $xw->text($personData["HintCorrect"]);
            $xw->endElement();        // </HintCorrect>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintWrong1');  // <HintWrong1>
            $xw->text($personData["HintWrong1"]);
            $xw->endElement();        // </HintWrong1>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintWrong2');  // <HintWrong2>
            $xw->text($personData["HintWrong2"]);
            $xw->endElement();        // </HintWrong2>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintWrong3');  // <HintWrong3>
            $xw->text($personData["HintWrong3"]);
            $xw->endElement();        // </HintWrong3>
            $xw->text("\n\t\t\t");

			$xw->endElement();          // </Type8>
			$xw->text("\n");
		}
	}

}

function writeType18XML($xw,$data)
{

	if (is_array($data))
	{
		foreach($data as $personNumber=>$personData)
		{
			$xw->text("\n\t\t");
			$xw->startElement('Type18'); // <Type18>
			$xw->text("\n\t\t\t");
			$xw->startElement('ID');  // <ID>
			$xw->text($personData["ID"]);
			$xw->endElement();        // </ID>
			$xw->text("\n\t\t\t");
            $xw->startElement('Difficulty');  // <Difficulty>
            $xw->text($personData["Difficulty"]);
            $xw->endElement();        // </Difficulty>
            $xw->text("\n\t\t\t");
            $xw->startElement('ClassID');  // <ClassID>
            $xw->text($personData["ClassID"]);
            $xw->endElement();        // </ClassID>
            $xw->text("\n\t\t\t");
            $xw->startElement('SubjectID');  // <SubjectID>
            $xw->text($personData["SubjectID"]);
            $xw->endElement();        // </SubjectID>
            $xw->text("\n\t\t\t");
            $xw->startElement('SubsubjectID');  // <SubsubjectID>
            $xw->text($personData["SubsubjectID"]);
            $xw->endElement();        // </SubsubjectID>
            $xw->text("\n\t\t\t");
            $xw->startElement('AuthorID');  // <AuthorID>
            $xw->text($personData["AuthorID"]);
            $xw->endElement();        // </AuthorID>
            $xw->text("\n\t\t\t");
            $xw->startElement('Source');  // <Source>
            $xw->text($personData["Source"]);
            $xw->endElement();        // </Source>
            $xw->text("\n\t\t\t");
            $xw->startElement('Link');  // <Link>
            $xw->text($personData["Link"]);
            $xw->endElement();        // </Link>
            $xw->text("\n\t\t\t");
            $xw->startElement('Approved');  // <Approved>
            $xw->text($personData["Approved"]);
            $xw->endElement();        // </Approved>
            $xw->text("\n\t\t\t");
            $xw->startElement('Question');  // <Question>
            $xw->text($personData["Question"]);
            $xw->endElement();        // </Question>
            $xw->text("\n\t\t\t");
            $xw->startElement('QuestionPic');  // <QuestionPic>
            $xw->text($personData["QuestionPic"]);
            $xw->endElement();        // </QuestionPic>
            $xw->text("\n\t\t\t");
            $xw->startElement('CorrectA');  // <CorrectA>
            $xw->text($personData["CorrectA"]);
            $xw->endElement();        // </CorrectA>
            $xw->text("\n\t\t\t");
            $xw->startElement('Wrong1');  // <Wrong1>
            $xw->text($personData["Wrong1"]);
            $xw->endElement();        // </Wrong1>
            $xw->text("\n\t\t\t");
            $xw->startElement('Wrong2');  // <Wrong2>
            $xw->text($personData["Wrong2"]);
            $xw->endElement();        // </Wrong2>
            $xw->text("\n\t\t\t");
            $xw->startElement('Wrong3');  // <Wrong3>
            $xw->text($personData["Wrong3"]);
            $xw->endElement();        // </Wrong3>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintCorrect');  // <HintCorrect>
            $xw->text($personData["HintCorrect"]);
            $xw->endElement();        // </HintCorrect>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintWrong1');  // <HintWrong1>
            $xw->text($personData["HintWrong1"]);
            $xw->endElement();        // </HintWrong1>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintWrong2');  // <HintWrong2>
            $xw->text($personData["HintWrong2"]);
            $xw->endElement();        // </HintWrong2>
            $xw->text("\n\t\t\t");
            $xw->startElement('HintWrong3');  // <HintWrong3>
            $xw->text($personData["HintWrong3"]);
            $xw->endElement();        // </HintWrong3>
            $xw->text("\n\t\t\t");

			$xw->endElement();          // </Type18>
			$xw->text("\n");
		}
	}

}

function writeType50XML($xw,$data)
{

	if (is_array($data))
	{
		foreach($data as $personNumber=>$personData)
		{
			$xw->text("\n\t\t");
			$xw->startElement('Type50'); // <Type50>
			$xw->text("\n\t\t\t");
			$xw->startElement('ID');  // <ID>
			$xw->text($personData["ID"]);
			$xw->endElement();        // </ID>
			$xw->text("\n\t\t\t");
            $xw->startElement('Difficulty');  // <Difficulty>
            $xw->text($personData["Difficulty"]);
            $xw->endElement();        // </Difficulty>
            $xw->text("\n\t\t\t");
            $xw->startElement('ClassID');  // <ClassID>
            $xw->text($personData["ClassID"]);
            $xw->endElement();        // </ClassID>
            $xw->text("\n\t\t\t");
            $xw->startElement('SubjectID');  // <SubjectID>
            $xw->text($personData["SubjectID"]);
            $xw->endElement();        // </SubjectID>
            $xw->text("\n\t\t\t");
            $xw->startElement('SubsubjectID');  // <SubsubjectID>
            $xw->text($personData["SubsubjectID"]);
            $xw->endElement();        // </SubsubjectID>
            $xw->text("\n\t\t\t");
            $xw->startElement('AuthorID');  // <AuthorID>
            $xw->text($personData["AuthorID"]);
            $xw->endElement();        // </AuthorID>
            $xw->text("\n\t\t\t");
            $xw->startElement('Source');  // <Source>
            $xw->text($personData["Source"]);
            $xw->endElement();        // </Source>
            $xw->text("\n\t\t\t");
            $xw->startElement('Link');  // <Link>
            $xw->text($personData["Link"]);
            $xw->endElement();        // </Link>
            $xw->text("\n\t\t\t");
            $xw->startElement('Approved');  // <Approved>
            $xw->text($personData["Approved"]);
            $xw->endElement();        // </Approved>
            $xw->text("\n\t\t\t");
            $xw->startElement('Question');  // <Question>
            $xw->text($personData["Question"]);
            $xw->endElement();        // </Question>
            $xw->text("\n\t\t\t");
            $xw->startElement('QuestionPic');  // <QuestionPic>
            $xw->text($personData["QuestionPic"]);
            $xw->endElement();        // </QuestionPic>
            $xw->text("\n\t\t\t");
            $xw->startElement('CorrectA');  // <CorrectA>
            $xw->text($personData["CorrectA"]);
            $xw->endElement();        // </CorrectA>
            $xw->text("\n\t\t\t");
            $xw->startElement('Wrong1');  // <Wrong1>
            $xw->text($personData["Wrong1"]);
            $xw->endElement();        // </Wrong1>
            $xw->text("\n\t\t\t");
            $xw->startElement('Wrong2');  // <Wrong2>
            $xw->text($personData["Wrong2"]);
            $xw->endElement();        // </Wrong2>
            $xw->text("\n\t\t\t");
            $xw->startElement('Wrong3');  // <Wrong3>
            $xw->text($personData["Wrong3"]);
            $xw->endElement();        // </Wrong3>
            $xw->text("\n\t\t\t");

			$xw->endElement();          // </Type50>
			$xw->text("\n");
		}
	}

}

function writeType50FeedbackXML($xw,$data)
{

	if (is_array($data))
	{
		foreach($data as $personNumber=>$personData)
		{
			$xw->text("\n\t\t");
			$xw->startElement('Type50FB'); // <Type50FB>
			$xw->text("\n\t\t\t");
			$xw->startElement('ID');  // <ID>
			$xw->text($personData["ID"]);
			$xw->endElement();        // </ID>
			$xw->text("\n\t\t\t");
            $xw->startElement('QuestionID');  // <QuestionID>
            $xw->text($personData["QuestionID"]);
            $xw->endElement();        // </QuestionID>
            $xw->text("\n\t\t\t");
            $xw->startElement('AnswerID');  // <AnswerID>
            $xw->text($personData["AnswerID"]);
            $xw->endElement();        // </AnswerID>
            $xw->text("\n\t\t\t");
            $xw->startElement('FTID');  // <FTID>
            $xw->text($personData["FTID"]);
            $xw->endElement();        // </FTID>
            $xw->text("\n\t\t\t");
            $xw->startElement('Feedback');  // <Feedback>
            $xw->text($personData["Feedback"]);
            $xw->endElement();        // </Feedback>
            $xw->text("\n\t\t");

			$xw->endElement();          // </Type50FB>
			$xw->text("\n");
		}
	}

}

function writeType6XML($xw,$data)
{


	if (is_array($data)) {
		foreach($data as $personNumber=>$personData)
		{

			$xw->text("\n\t\t");
			$xw->startElement('Type6'); // <Type6>
			$xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Difficulty');  // <Difficulty>
                $xw->text($personData["Difficulty"]);
                $xw->endElement();        // </Difficulty>
                $xw->text("\n\t\t\t");
                $xw->startElement('ClassID');  // <ClassID>
                $xw->text($personData["ClassID"]);
                $xw->endElement();        // </ClassID>
                $xw->text("\n\t\t\t");
                $xw->startElement('SubjectID');  // <SubjectID>
                $xw->text($personData["SubjectID"]);
                $xw->endElement();        // </SubjectID>
                $xw->text("\n\t\t\t");
                $xw->startElement('SubsubjectID');  // <SubsubjectID>
                $xw->text($personData["SubsubjectID"]);
                $xw->endElement();        // </SubsubjectID>
                $xw->text("\n\t\t\t");
                $xw->startElement('AuthorID');  // <AuthorID>
                $xw->text($personData["AuthorID"]);
                $xw->endElement();        // </AuthorID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Source');  // <Source>
                $xw->text($personData["Source"]);
                $xw->endElement();        // </Source>
                $xw->text("\n\t\t\t");
                $xw->startElement('Link');  // <Link>
                $xw->text($personData["Link"]);
                $xw->endElement();        // </Link>
                $xw->text("\n\t\t\t");
                $xw->startElement('Approved');  // <Approved>
                $xw->text($personData["Approved"]);
                $xw->endElement();        // </Approved>
                $xw->text("\n\t\t\t");
                $xw->startElement('Question');  // <Question>
                $xw->text($personData["Question"]);
                $xw->endElement();        // </Question>
                $xw->text("\n\t\t");
			$xw->endElement();          // </Type6>
			$xw->text("\n");

		}



	}

}


function writeType6AnswersXML($xw,$data)
{
	if (is_array($data)) {
		foreach($data as $personNumber=>$personData)
		{

			$xw->text("\n\t\t");
			$xw->startElement('Type6A'); // <Type6A>
			$xw->text("\n\t\t\t");
                $xw->startElement('ID');  // <ID>
                $xw->text($personData["ID"]);
                $xw->endElement();        // </ID>
                $xw->text("\n\t\t\t");
                $xw->startElement('QuestionID');  // <QuestionID>
                $xw->text($personData["QuestionID"]);
                $xw->endElement();        // </QuestionID>
                $xw->text("\n\t\t\t");
                $xw->startElement('Answer');  // <Answer>
                $xw->text($personData["Answer"]);
                $xw->endElement();        // </Answer>
                $xw->text("\n\t\t\t");
                $xw->startElement('Hint');  // <Hint>
                $xw->text($personData["Hint"]);
                $xw->endElement();        // </Hint>
                $xw->text("\n\t\t\t");
                $xw->startElement('Correct');  // <Correct>
                $xw->text($personData["Correct"]);
                $xw->endElement();        // </Correct>
                $xw->text("\n\t\t");
			$xw->endElement();          // </Type6A>
			$xw->text("\n");

		}


	}

}

function closeXMLWriter($xw)
{
	$xw->endElement();       //  </questions>
    $xw->endDtd();
    print $xw->outputMemory(true);
}

?>