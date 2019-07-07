import React from 'react';
import { Route } from 'react-router-dom';
import { List, Create, Update, Show } from '../components/tasklist/';

export default [
  <Route path="/task_lists/create" component={Create} exact key="create" />,
  <Route path="/task_lists/edit/:id" component={Update} exact key="update" />,
  <Route path="/task_lists/show/:id" component={Show} exact key="show" />,
  <Route path="/task_lists/" component={List} exact strict key="list" />,
  <Route path="/task_lists/:page" component={List} exact strict key="page" />
];
