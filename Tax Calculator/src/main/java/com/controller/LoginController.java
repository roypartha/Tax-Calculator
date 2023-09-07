package com.controller;

import com.domain.User;
import com.service.UserService;
import org.springframework.beans.propertyeditors.StringTrimmerEditor;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.WebDataBinder;
import org.springframework.web.bind.annotation.*;

@CrossOrigin()
@RestController
@RequestMapping("/login")
public class LoginController {
    private UserService userService;

    public LoginController(UserService userService) {
        this.userService = userService;
    }

    @InitBinder
    public void initBinder(WebDataBinder webDataBinder) {
        StringTrimmerEditor stringTrimmerEditor = new StringTrimmerEditor(true);
        webDataBinder.registerCustomEditor(String.class, stringTrimmerEditor);
    }

    @GetMapping
    public String login(@RequestParam(value = "error", defaultValue = "false") boolean loginError) {
        if (loginError) {
            return "hoise pass";
        }
        return "hoise pass";
    }

    @GetMapping("/name/{username}")
    public User greetUser(@PathVariable("username") String username) {
        System.out.println("controller- " + username);
        return userService.getByUsername(username);
    }
    @GetMapping("/success")
    public String success(){
        return "hoise";
    }
//    @GetMapping("/role")
//    @PreAuthorize("hasRole('ROLE_ADMIN')")
//
//    public String greetAdmin() {
//
//        System.out.println();
//        return "admin";
//    }
}