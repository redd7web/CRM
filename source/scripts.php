
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>

<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
<script type="text/javascript" src="js/jquery.dropdown.js"></script>
<script type="text/javascript" src="js/hoverIntent.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="plugins/shadow/shadowbox.js"></script>
<script type="text/javascript" src="js/timepicker.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/Chart.js" ></script>
<script type="text/javascript">
Shadowbox.init({
    showOverlay:true,
    modal:false, 
    loadingImage:"shadow/loading.gif",
    displayNav: true,
    slideshowDelay: 2,        
    overlayOpacity: '0.9',
    overlayColor:"#FFFFFF",
    gallery: "gall" ,
        
});

var fixHelper = function(e, ui) {
	ui.children().each(function() {
		$(this).width($(this).width());
	});
	return ui;
};

$(function() {
	$( "#tabs" ).tabs();
    $( "#sortable tbody" ).sortable({    
            helper: fixHelper
     }).disableSelection();
    
});

</script>

<?php
    if(isset($_SESSION['id'])){
?>
<script type="text/babel">

'use strict';

class DropdownMenu extends React.Component {

  getMenuItemTitle = (menuItem, index, depthLevel) => {
    return menuItem.title;
  };

  getMenuItem = (menuItem, depthLevel, index) => {
    let title = this.getMenuItemTitle(menuItem, index, depthLevel);

    if (menuItem.submenu && menuItem.submenu.length > 0) {
      return (
        <li style={{ cursor:"pointer" }}>
          {title}
          <DropdownMenu config={menuItem.submenu} submenu={true} />
        </li>
      );
    } else {
      return <li>{title}</li>;
    }
  };

  render = () => {
    let { config } = this.props;

    let options = [];
    config.map((item, index) => {
      options.push(this.getMenuItem(item, 0, index));
    });

    if (this.props.submenu && this.props.submenu === true)
      return <ul>{options}</ul>;

    return <ul className="dropdown-menu">{options}</ul>;
  };
}



ReactDOM.render(<DropdownMenu config={[
    {
        "title": "Management",
        "submenu": [
        { "title": <a href='cost_calc.php' target='_blank'>Job Cost Calculator</a> },
        { 
          "title":"Tools",
          "submenu":[
                {"title":<a href='roi.php' target='_blank'>ROI Calculator</a>},
                {"title":<a href='management.php?task=forecast'>Oil Forecaster</a>}
           ]
        },
        {
          "title": <a href='management.php?task=overview'>Overview</a>,
          "submenu": [
            { "title": <a href='management.php?task=driverslog'>Drivers Log</a>}
          ]
        },
        {
          "title": "Reports",
          "submenu": [
            { "title": <a href='management.php?task=ops'>Oil Pickup Summary</a> },
            { "title": <a href='management.php?task=ocd'>Oil Collection By Driver</a> },
            { "title": <a href='management.php?task=expire'>Account Expirations</a> },
            { "title": <a href='management.php?task=cancel'>Account Cancellations</a> },
            { "title": <a href='management.php?task=theft'>Oil Theft</a> },
            { "title": <a href='management.php?task=zero'>Zero-Gallon Pickups</a> },
            { "title": <a href='management.php?task=delivery'>Container Deliveries</a> },
            { "title": <a href='management.php?task=collected'>Collected Emergencies</a> },
            { "title": <a href='management.php?task=csupport'>Customer Support</a> },
            { "title": <a href='management.php?task=newloc'>New Locations</a> }
          ]
        },
        {
          "title": "Exports",
          "submenu": [
            {"title": <a href='management.php?task=picknpay'>Pickups & Payments</a> },
            {"title": <a href='management.php?task=alloil'>All Oil Collections</a> },
            {"title": <a href='management.php?task=oilperloc'>Oil Collections Per</a> },
            {"title": <a href='management.php?task=affil'>Affiliate Breakout Per Route</a> }
          ]
        },
        {
          "title": "Users",
          "submenu": [
            {
              "title": <a href='management.php?task=adduser'>Add New User</a>,
              "submenu": null
            },
            {
              "title": <a href='management.php?task=staff'>View Users (Admin Only)</a>,
              "submenu": null
            }
          ]
        },
        { "title": <a href="management.php?task=friendly">Friendly</a>},
        { "title": <a href='management.php?task=xlog'>Transaction Log</a> }
      ]
    },
    {
      "title": "Customers",
      "submenu": [
        { "title":<a href='customers.php?task=accounts'>Accounts</a> },
        { "title": <a href='customers.php?task=newaccount'>New Accounts</a>},
        { "title": <a href='customers.php?task=tracker'>Startup Tracker</a> },
        { "title": <a href='customers.php?task=issues'>Service Issues</a> },
        { "title": <a href='customers.php?task=services'>Ending Service</a>}
      ]
    },
    {
      "title": "Scheduling",
      "submenu": [
        {
          "title":"Oil Emergencies",
          "submenu": [
            {"title": <a href='scheduling.php?task=oilcomplete'>Completed</a>},
            {"title": <a href='scheduling.php?task=oilongoing'>Ongoing</a>}
          ],
        },
        {
          "title": "Oil Pickups",
          "submenu": [
            { "title": <a href='scheduling.php?task=schoipu'>Scheduled Oil Pickups</a>},
            { "title": <a href='scheduling.php?task=rop'>Routed Oil Pickups</a> },
            { "title":<a href='scheduling.php?task=cop'>Completed Oil Pickups</a> }
          ]
        }
      ]
    }
  ]}/>, document.querySelector("#menu_drown_down"));
  
  
class FormContainer extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      newUser: {
        name: "",
        age: "",
        gender: "",
        skills: [],
        about: ""
      },

      genderOptions: ["Male", "Female", "Others"],
      skillOptions: ["Programming", "Development", "Design", "Testing"]
    };
    this.handleTextArea = this.handleTextArea.bind(this);
    this.handleAge = this.handleAge.bind(this);
    this.handleFullName = this.handleFullName.bind(this);
    this.handleFormSubmit = this.handleFormSubmit.bind(this);
    this.handleClearForm = this.handleClearForm.bind(this);
    this.handleCheckBox = this.handleCheckBox.bind(this);
    this.handleInput = this.handleInput.bind(this);
  }

  /* This lifecycle hook gets executed when the component mounts */

  handleFullName(e) {
    let value = e.target.value;
    this.setState(
      prevState => ({
        newUser: {
          ...prevState.newUser,
          name: value
        }
      }),
      () => console.log(this.state.newUser)
    );
  }

  handleAge(e) {
    let value = e.target.value;
    this.setState(
      prevState => ({
        newUser: {
          ...prevState.newUser,
          age: value
        }
      }),
      () => console.log(this.state.newUser)
    );
  }

  handleInput(e) {
    let value = e.target.value;
    let name = e.target.name;
    this.setState(
      prevState => ({
        newUser: {
          ...prevState.newUser,
          [name]: value
        }
      }),
      () => console.log(this.state.newUser)
    );
  }

  handleTextArea(e) {
    console.log("Inside handleTextArea");
    let value = e.target.value;
    this.setState(
      prevState => ({
        newUser: {
          ...prevState.newUser,
          about: value
        }
      }),
      () => console.log(this.state.newUser)
    );
  }

  handleCheckBox(e) {
    const newSelection = e.target.value;
    let newSelectionArray;

    if (this.state.newUser.skills.indexOf(newSelection) > -1) {
      newSelectionArray = this.state.newUser.skills.filter(
        s => s !== newSelection
      );
    } else {
      newSelectionArray = [...this.state.newUser.skills, newSelection];
    }

    this.setState(prevState => ({
      newUser: { ...prevState.newUser, skills: newSelectionArray }
    }));
  }

  handleFormSubmit(e) {
    e.preventDefault();
    let userData = this.state.newUser;

    fetch("http://example.com", {
      method: "POST",
      body: JSON.stringify(userData),
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json"
      }
    }).then(response => {
      response.json().then(data => {
        console.log("Successful" + data);
      });
    });
  }

  handleClearForm(e) {
    e.preventDefault();
    this.setState({
      newUser: {
        name: "",
        age: "",
        gender: "",
        skills: [],
        about: ""
      }
    });
  }

  render() {
    return (
      <form className="container-fluid" onSubmit={this.handleFormSubmit}>
        <Input
          inputType={"text"}
          title={"Full Name"}
          name={"name"}
          value={this.state.newUser.name}
          placeholder={"Enter your name"}
          handleChange={this.handleInput}
        />{" "}
        {/* Name of the user */}
        <Input
          inputType={"number"}
          name={"age"}
          title={"Age"}
          value={this.state.newUser.age}
          placeholder={"Enter your age"}
          handleChange={this.handleAge}
        />{" "}
        {/* Age */}
        <Select
          title={"Gender"}
          name={"gender"}
          options={this.state.genderOptions}
          value={this.state.newUser.gender}
          placeholder={"Select Gender"}
          handleChange={this.handleInput}
        />{" "}
        {/* Age Selection */}
        <CheckBox
          title={"Skills"}
          name={"skills"}
          options={this.state.skillOptions}
          selectedOptions={this.state.newUser.skills}
          handleChange={this.handleCheckBox}
        />{" "}
        {/* Skill */}
        <TextArea
          title={"About you."}
          rows={10}
          value={this.state.newUser.about}
          name={"currentPetInfo"}
          handleChange={this.handleTextArea}
          placeholder={"Describe your past experience and skills"}
        />
        {/* About you */}
        <Button
          action={this.handleFormSubmit}
          type={"primary"}
          title={"Submit"}
          style={buttonStyle}
        />{" "}
        {/*Submit */}
        <Button
          action={this.handleClearForm}
          type={"secondary"}
          title={"Clear"}
          style={buttonStyle}
        />{" "}
        {/* Clear the form */}
      </form>
    );
  }
}

const buttonStyle = {
  margin: "10px 10px 10px 10px"
};

ReactDOM.render(<FormContainer />,document.querySelector("#form_space") );


</script>
<?php
}
?>

