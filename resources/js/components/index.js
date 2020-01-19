import React, { Component } from 'react';
import ReactDOM from "react-dom";
import App from "./App";

if (document.getElementById('first-react-component')) {
    ReactDOM.render(<App />, document.getElementById('first-react-component'));
}