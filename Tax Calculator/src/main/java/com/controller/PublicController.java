package com.controller;

import com.domain.Tax;
import com.domain.User;
import com.service.TaxService;
import com.service.UserService;
import org.springframework.beans.propertyeditors.StringTrimmerEditor;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.WebDataBinder;
import org.springframework.web.bind.annotation.*;

import java.security.Principal;
import java.util.List;

@CrossOrigin()
@RestController
@RequestMapping("/public")
public class PublicController {
    private UserService userService;
    private TaxService taxService;

    public PublicController(UserService userService, TaxService taxService) {
        this.userService = userService;
        this.taxService = taxService;
    }

    @InitBinder
    public void initBinder(WebDataBinder webDataBinder) {
        StringTrimmerEditor stringTrimmerEditor = new StringTrimmerEditor(true);
        webDataBinder.registerCustomEditor(String.class, stringTrimmerEditor);
    }

    @GetMapping(value = "/username")
    public User currentUserName() {//Principal principal
        //return principal.getName();
        return userService.get(1L);
    }

    @GetMapping("/login-user")
    @PreAuthorize("hasRole('ROLE_USER')")
    public String loginUser(Principal principal) {
        return principal.getName();
    }

    @GetMapping("/login-admin")
    @PreAuthorize("hasRole('ROLE_ADMIN')")
    public String loginAdmin(Principal principal) {
        //SecurityContextHolder.getContext().getAuthentication().getPrincipal();
        return principal.getName();
    }
}
